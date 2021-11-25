<?php
require_once("Action/JeuAction.php");

$action = new JeuAction();
$data = $action->execute();
$page_title="Jeu";

require_once("Partial/header.php");
?>


<link rel="stylesheet" href="./CSS/jeu.css">

<div class="container">
  <div class="Hero-enemie">
  <div class = "Hero">
    <div id = "EnemieHero"></div>
  </div>

  </div>
  <div class="Hero-me">

  <div class = "Hero">
    <div id = "SelectedHero"></div>
    <div class = "Power">
        5/10 POWER
    </div>
  </div>

  </div>
  <div class="Card-left">
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    </div>
    <div class="Card-right">
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
    <div class = "Card">

    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
</div>

  </div>
  <div class="Card-Left-enemie">
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>
  </div>
  <div class="Card-Right-enemie">
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>
    <div class = "CartEnemie"></div>

  </div>
  <div class="Board-enemie">
    <div class = "Cardboard">
    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>

  </div>
  <div class="Board-me">
    <div class = "Cardboard">
    <span class = "Vie"> 5 </span>
    <span class = "Name"> name</span>
    <span class = "Description">desctiption</span>
    </div>
  </div>
  <div class="Button-left">
    <div id = timer_area>
        <span>50 seconds</span>
    </div>
    <button>Next turn</button>
    <button>Active power</button>
    
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