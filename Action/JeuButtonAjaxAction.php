<?php
	require_once("action/CommonAction.php");

class JeuButtonAjaxAction extends CommonAction
{

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        
    }

    protected function executeAction() {
       $result = false;
       $data = [];
       $data["key"] = $_SESSION["key"];

     
       switch($_POST["typebutton"])
       {
           case "end":
                $data["type"] = "END_TURN";
                $result = parent::callAPI("games/action",$data);
                break;
            case "surrender":
                $data["type"] = "SURRENDER";
                $result = parent::callAPI("games/action",$data);
                break;
            case "hero":
                $data["type"] = "HERO_POWER";
                $result = parent::callAPI("games/action",$data);
                break;
       }
        return compact("result");
    }
}

