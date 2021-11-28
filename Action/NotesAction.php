<?php

require_once("action/CommonAction.php");
class NotesAction extends CommonAction
{

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        
    }

    protected function executeAction() {
        if (isset($_POST["text"])) {
			$post = array();
			$post["text"] = $_POST["text"];
			$_SESSION["posts"][] = $post;
		}
			
		if (!isset($_SESSION["posts"])) {
			$_SESSION["posts"] = array();
		}
		
		$memos = $_SESSION["posts"];
		
		return compact("memos");
        
    }
}