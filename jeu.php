<?php
require_once("Action/JeuAction.php");

$action = new JeuAction();
$data = $action->execute();
$page_title="Jeu";

require_once("Partial/header.php");
?>