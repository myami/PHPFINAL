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
					Qu'avez-vous en tête : <input type="text" name="text" value="" />
					<input type="submit" value="Ajouter"/>
				</div>
				
			</form>
			
			<div class="container">
				<?php
					if (sizeof($data["memos"]) > 0) {
						foreach ($data["memos"] as $post) {
							?>
							<div class="post-it"><?= $post["text"] ?> </div>
							<?php
						}
					}	
				?>
			</div>
		</div>



<?php
	require_once("partial/footer.php");