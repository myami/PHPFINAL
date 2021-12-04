<?php
session_start();

require_once("Action/constants.php");
abstract class CommonAction
{
    protected static $VISIBILITY_ADMIN = 3;
    protected static $VISIBILITY_MODERATEUR = 2;
    protected static $VISIBILITY_MEMBER = 1;
    protected static $VISIBILITY_PUBLIC = 0;
    
    private $visibility = null;
    

    public function __construct($visibility) {
        $this->visibility = $visibility;
    }
    
    public function execute() {
        
        if (isset($_GET["action"])) {
            if ($_GET["action"] === "logout") {
                session_unset();
                session_destroy();
            }
        }
    
        if ($this->visibility > CommonAction::$VISIBILITY_PUBLIC) {
            if (!isset($_SESSION["visibility"]) || $_SESSION["visibility"] < $this->visibility) {
                header("location:index.php");
                exit;
            }
        }
        
        return $this->executeAction();
    }
    
    abstract protected function executeAction();
    
    public function getUsername() {
        return $_SESSION["username"];
    }
    
    public function isLoggedIn() {
        return isset($_SESSION["username"]);
    }
    
    public function getCurrentPage() {
        $pageURL = 'http://';
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    /**
     * data = array('key1' => 'value1', 'key2' => 'value2');
     */
    public function callAPI($service, array $data) {
        $apiURL = "https://magix.apps-de-cours.com/api/" . $service;

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($apiURL, false, $context);

    if (strpos($result, "<br") !== false) {
            var_dump($result);
            exit;
        }
        
    return json_decode($result);
    }


}