<?php
require_once("Action/NotesAction.php");

$action = new NotesAction();
$data = $action->execute();
$page_title="Notes";

require_once("Partial/header.php");
?>