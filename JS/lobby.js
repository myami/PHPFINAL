const applyStyles = iframe => {
	let styles = {
		fontColor : "#000000",
		backgroundColor : "rgba(128, 128, 128, 0.9)"

	}
	
	setTimeout(() => {
		iframe.contentWindow.postMessage(JSON.stringify(styles), "*");	
}, 100);
}

const lobby = (gametype) => {
	if(gametype == "note"){
		window.location.href = "./notes.php";
	}
	let formData = new FormData();
	formData.append("gametype", gametype);

	fetch("LobbyAjax.php", {
		method : "POST",
		credentials : 'include',
		body : formData
	})
	.then(response => response.json())
	.then(response => {
		switch(response){
			case "SIGNED_OUT":
				signout();
				break;
			case "DECK_INCOMPLETE":
				alert("Deck pas configurer ou incomplet!!");
				break;
			case "MAX_DEATH_THRESHOLD_REACHED":
				alert("tu est mort trop de fois pendant le tournoi");
				break;
		}
		if (response == "JOINED_PVP" || "CREATED_PVP" || "JOINED_TRAINING" ){
			launchGame();
		}
	})
}

window.addEventListener("load", () => {
	document.querySelector("#training_container").addEventListener("click", training);
	document.querySelector("#play_container").addEventListener("click", jouer);
	document.querySelector("#notes_container").addEventListener("click", notes);
	document.querySelector("#leave_container").addEventListener("click", quitter);


	
});


function training(){
	lobby("training");
}	
function jouer(){
	lobby("jouer");
}
function notes(){
	window.location.href = "./notes.php";
}
function quitter(){
	lobby("quitter");
}

function signout(){
	window.location.href = "./index.php";
}

function launchGame(){

	window.location.href = "./jeu.php";
}

