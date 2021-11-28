<?php
	require_once("action/CommonAction.php");

class LobbyAjaxAction extends CommonAction
{

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        
    }

    protected function executeAction() {
       $result = false;
       $data = [];
       $data["key"] = $_SESSION["key"];

     
       switch($_POST["gametype"])
       {
           case "quitter":
                $result = parent::callAPI("signout",$data);
                
                break;
            case "jouer":
                $data["type"] = "PVP";
                $result = parent::callAPI("games/auto-match",$data);
                break;
            case "training":
                $data["type"] = "TRAINING";
                $result = parent::callAPI("games/auto-match",$data);
                break;
       }
        return compact("result");
    }
}

