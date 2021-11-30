<?php
	require_once("action/CommonAction.php");
    require_once("action/DAO/ContentDAO.php");
    
class IndexAction extends CommonAction
{

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        
    }

    protected function executeAction() {
        $hasConnectionError = false;
    if (isset($_POST["Username"])) 
    {
        $data = [];
        $data["username"] = $_POST["Username"];
        $data["password"] = $_POST["Password"];
        $result = parent::callAPI("signin", $data);

        if ($result == "INVALID_USERNAME_PASSWORD") {
            // err
            $hasConnectionError = true;
        }
        else {
            $key = $result->key;
            $_SESSION["key"] = $key;
            ContentDAO::setIndexText($data["username"]);
            header("location:lobby.php");
            exit;

        }
    }


        return compact("hasConnectionError");
    }
}