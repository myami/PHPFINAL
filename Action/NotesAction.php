<?php

require_once("action/CommonAction.php");
require_once("action/DAO/ContentDAO.php");

class NotesAction extends CommonAction
{

    public function __construct() {
        parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        
    }

    protected function executeAction() {


        if (isset($_POST["text"])) {
			ContentDAO::WriteNote($_POST["text"]);
		}

        if(!empty($_POST["id"])){
            ContentDAO::DeleteNote($_POST["id"]);
        }
			
		
		$memos = ContentDAO::GetAllNotes();
		
		return compact("memos");
        
    }
}