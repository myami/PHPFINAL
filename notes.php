<?php
require_once("Action/NotesAction.php");

$action = new NotesAction();
$data = $action->execute();
$page_title="Notes";

require_once("Partial/header.php");
?>

<link rel="stylesheet" href="./CSS/notes.css">

<div style="position:relative;">
			<form action="" method="post">
				<div>
					Une nouvelle analyse de carte : <input type="text" name="text" value="" />
					<input type="submit" value="Ajouter"/>
				</div>
				
			</form>
			
			<div class="container">
				<?php
					if (sizeof($data["memos"]) > 0) {
						foreach ($data["memos"] as $post) {
							?>
							<div class="post-it"><span class = "date"><?= $post["dateposte"] ?></span> <span class ="contenu"><?= $post["contenu"] ?></span> <form action="" method="post"> <input type="hidden" value = "<?= $post["noteid"] ?>" name = "id"><button> supprimer</button></form>  </div>
							<?php
						}
					}	
				?>
			</div>
		</div>



<?php
	require_once("partial/footer.php");