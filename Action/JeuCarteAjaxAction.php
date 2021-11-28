<?php
	require_once("action/CommonAction.php");

class JeuCarteAjaxAction extends CommonAction
{

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        
    }

    protected function executeAction() {
       $result = false;
       $data = [];
       $data["key"] = $_SESSION["key"];

     
       switch($_POST["typecarte"])
       {
           case "play":
                $data["type"] = "PLAY";
                $data["uid"] = $_POST["carte"];
                $result = parent::callAPI("games/action",$data);
                break;
            case "attack":
                $data["type"] = "ATTACK";
                $data["uid"] = $_POST["carte"];
                $data["targetuid"] = $_POST["target"];
                $result = parent::callAPI("games/action",$data);
                break;

       }
        return compact("result");
    }
}

