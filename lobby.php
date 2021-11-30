<?php
require_once("Action/LobbyAction.php");

$action = new LobbyAction();
$data = $action->execute();
$page_title="Lobby";

require_once("Partial/header.php");
?>

<link rel="stylesheet" href="./CSS/lobby.css">
<script src="./JS/lobby.js"></script>

<div id = "menu">
    <div id= "menu_container" >
        
        <button type="button" id = "training_container" class = "item_menu" >
            <h1>Training</h1>
        </button>

        <button type="button" id = "play_container" class = "item_menu">
            <h1>Play</h1>
        </button>
        <button type="button" id = "notes_container" class = "item_menu">
            <h1>Notes</h1>
        </button>
        <button type="button" id = "leave_container" class = "item_menu">
            <h1>Leave</h1>
        </button>

    </div>

    <div id= "menu_chat">
    <iframe style="width:700px;height:240px;" onload="applyStyles(this)"  
        src="https://magix.apps-de-cours.com/server/#/chat/<?php echo $_SESSION["key"] ?>">
    </iframe>
    </div>

</div>


<?php
	require_once("partial/footer.php");
