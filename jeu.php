<?php
require_once("Action/JeuAction.php");

$action = new JeuAction();
$data = $action->execute();
$page_title="Jeu";

require_once("Partial/header.php");
?>


<link rel="stylesheet" href="./CSS/jeu.css">
<script src="./JS/jeu.js"></script>

<div class="container">
  <div class="Hero-enemie">
  <div class = "Hero">
    <div id = "EnemieHero"></div>
  </div>

  </div>
  <div class="Hero-me">

  <div class = "Hero">
    <div id = "SelectedHero"></div>

  </div>

  </div>
  <div class="Card-left" id = "player-left">

    </div>
  <div class="Card-right" id = "player-right">

  </div>
  <div class="Card-Left-enemie" id ="opponent-left">

  </div>
  <div class="Card-Right-enemie"id = "opponent-right">


  </div>
  <div class="Board-enemie" id= "board-enemie">
  

  </div>
  <div class="Board-me"id = "board-player">
    
  </div>
  <div class="Button-left">
    <div id = timer_area>
        <span id = "timer">... seconds</span>
    </div>
    <button id = "Turn">Next turn</button>
    <button id = "hpower">Active power</button>
    
  </div>
  <div class="Button-right">
    <button>Give up</button>
    <button>Chat</button>
  </div>
  <div class="Bottom-left">
      <div class = "pioche">
          <span id="nbcartme" class= "nbpioche">30</span>
      </div>

  </div>
  <div class="bottom-right">
    <div class = "EnergieB">
        <span id = "energiePlayer">5</span>
    </div>
    <div class = "VieB">
    <span id = "ViePlayer">20</span>
    </div>
  </div>
  <div class="top-right">
  <div class = "EnergieB">
        <span id = "energieEnemie">5</span>
    </div>
    <div class = "VieB">
    <span id = "VieEnemie">20</span>
    </div>
  </div>
  <div class="top-left">
  <div class = "pioche">
          <span id="nbcartenemie" class= "nbpioche">30</span>
      </div>
  </div>
</div>



<?php
	require_once("partial/footer.php");