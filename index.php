<?php
require_once("Action/IndexAction.php");

$action = new IndexAction();
$data = $action->execute();
$page_title="Magix - Login";

require_once("Partial/header.php");
?>

<link rel="stylesheet" href="./CSS/index.css">

<form action="" method="post">
    <label for="fname">Username : </label>
    <input type="text" name="Username" id="user">
    <label for="fname">Password : </label>
    <input type="password" name="Password" id="pwd">
    <button>Connexion</button>
    <?php 
			if ($data["hasConnectionError"]) {
				?>
				<div class="error-div"><strong>Erreur : </strong>Connexion erronée</div>
				<?php
			}
		?>
</form>
