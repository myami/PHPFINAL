<?php
require_once("action/JeuButtonAjaxAction.php");

$action = new JeuButtonAjaxAction();
$data = $action->execute();

echo json_encode($data["result"]);