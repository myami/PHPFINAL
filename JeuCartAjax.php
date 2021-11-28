<?php
require_once("action/JeuCarteAjaxAction.php");

$action = new JeuCarteAjaxAction();
$data = $action->execute();

echo json_encode($data["result"]);