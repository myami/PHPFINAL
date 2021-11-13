<?php
require_once("Action/LobbyAction.php");

$action = new LobbyAction();
$data = $action->execute();
$page_title="Lobby";

require_once("Partial/header.php");
?>

<link rel="stylesheet" href="./CSS/lobby.css">

<div id= "menu_container" >
    

    <button type="button" id = "training_container" class = "item_menu">
        <h1>Training</h1>
    </button>

    <button type="button" id = "play_container" class = "item_menu">
        <h1>Play</h1>
    </button>
    <button type="button" id = "leave_container" class = "item_menu">
        <h1>Leave</h1>
    </button>

</div>
