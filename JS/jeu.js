const state = () => {
    fetch("JeuAjax.php", {   // Il faut créer cette page et son contrôleur appelle 
    method : "POST",       // l’API (games/state)
        credentials: "include"
    })
.then(response => response.json())
.then(data => {
    console.log(data);
    if (typeof data !== "object")
    {
        if (data == "GAME_NOT_FOUND") 
        {
                // Fin de la partie. Est-ce que j’ai gagné? Je dois appeler user-info
        }
        if (data == "WAITING")
        {
            alert("En attente de joueur");
        }
           
    }
    else 
    {
        DisplayData(data);
    }

    setTimeout(state, 1000); // Attendre 1 seconde avant de relancer l’appel
    })
}

window.addEventListener("load", () => {
setTimeout(state, 1000); // Appel initial (attendre 1 seconde)


});

const button = (type) => {
    let formData = new FormData();
	formData.append("typebutton", type);
    fetch("JeuButtonAjax.php", {   // Il faut créer cette page et son contrôleur appelle 
 
    method : "POST",       // l’API (games/state)
        credentials: "include",
        body : formData
    })
.then(response => response.json())
.then(data => {
    console.log(data);
    if (typeof data !== "object")
    {
       
           
    }
    else 
    {
       
    }

    })
}

const carte = (type,id,idtarget) => {
    // idtarget a null si play
    let formData = new FormData();
	formData.append("typecarte", type);
    formData.append("carte", id);
    formData.append("target", idtarget);
    fetch("JeuCartAjax.php", {   // Il faut créer cette page et son contrôleur appelle 
 
    method : "POST",       // l’API (games/state)
        credentials: "include",
        body : formData
    })
.then(response => response.json())
.then(data => {
    console.log(data);
    if (typeof data !== "object")
    {
       
           
    }
    else 
    {
       
    }

    })
}



function DisplayData(data)
{

    UpdatePlayerStats(data);
    UpdateEnemieStats(data);
    UpdateButton(data);
    UpdateCardEnemie(data);
    UpdateCardPlayer(data);
    UpdateBoardPlayer(data);
    UpdateBoardEnemie(data);

    document.querySelector("#timer").textContent = data["remainingTurnTime"];


}




function UpdatePlayerStats(data)
{

    document.querySelector("#ViePlayer").textContent = data["hp"];
    document.querySelector("#energiePlayer").textContent = data["mp"];
    document.querySelector("#nbcartme").textContent = data["remainingCardsCount"];


}

function UpdateButton(data){
    document.querySelector("#Turn").disabled = !data["yourTurn"];
    if (!data["yourTurn"] && data["heroPowerAlreadyUsed"])
    document.querySelector("#hpower").disabled = true;
    else
    document.querySelector("#hpower").disabled = false;

}

function UpdateEnemieStats(data){
    document.querySelector("#VieEnemie").textContent = data["opponent"]["hp"];
    document.querySelector("#energieEnemie").textContent = data["opponent"]["mp"];
    document.querySelector("#nbcartenemie").textContent = data["opponent"]["remainingCardsCount"];


}


function UpdateBoardPlayer(data){
    let boardplayer = document.querySelector("#board-player");
    while (boardplayer.firstChild) {
        boardplayer.removeChild(boardplayer.firstChild);
    }
    for(let i =0; i < data["board"].length;i++)
    {
        boardplayer.appendChild(AddCard(data["board"][i]));
    }


}

function UpdateBoardEnemie(data){
    let boardenemie = document.querySelector("#board-enemie");
    while (boardenemie.firstChild) {
        boardenemie.removeChild(boardenemie.firstChild);
    }
    for(let i =0; i < data["opponent"]["board"].length;i++)
    {
        boardenemie.appendChild(AddCard(data["opponent"]["board"][i]));
    }

}

function UpdateCardEnemie(data){
    let leftenemie = document.querySelector("#opponent-left");
    let rightenemie = document.querySelector("#opponent-right");
    while (leftenemie.firstChild) {
        leftenemie.removeChild(leftenemie.firstChild);
    }
    while (rightenemie.firstChild) {
        rightenemie.removeChild(rightenemie.firstChild);
    }
    var cartenemie = document.createElement("div");  
    cartenemie.className = "CartEnemie";
    if(data["opponent"]["handSize"] < 5){
        
        for (let i = 0; i <data["opponent"]["handSize"];i++ ){
            leftenemie.appendChild(cartenemie);
        }
    }
    else{
        for (let i = 0; i <= 5;i++ ){
            leftenemie.appendChild(cartenemie);
        }
        for (let i = 5; i < data["opponent"]["handSize"];i++ ){
            rightenemie.appendChild(cartenemie);
        }
    }


}

function UpdateCardPlayer(data){
    let leftplayer = document.querySelector("#player-left");
    let rightplayer = document.querySelector("#player-right");
    while (leftplayer.firstChild) {
        leftplayer.removeChild(leftplayer.firstChild);
    }
    while (rightplayer.firstChild) {
        rightplayer.removeChild(rightplayer.firstChild);
    }

    

    if(data["opponent"]["handSize"] <= 5){
        
        for (let i = 0; i <data["opponent"]["handSize"];i++ ){
            
            leftplayer.appendChild(AddCard(data["hand"][i]));
        }
    }
    else{
        for (let i = 0; i < 5;i++ ){
            leftplayer.appendChild(AddCard(data["hand"][i]));
        }
        for (let i = 5; i < data["opponent"]["handSize"];i++ ){
            rightplayer.appendChild(AddCard(data["hand"][i]));
        }
    }
}


function AddCard(data){
    var carte = document.createElement("div");  
    carte.className = "Card";
    var vie = document.createElement("span");
    vie.textContent = data["hp"];
    var cost = document.createElement("span");
    cost.textContent = data["cost"];
    var atk = document.createElement("span");
    atk.textContent = data["atk"];
    var mechanic = document.createElement("span");
    mechanic.textContent = data["mechanics"];

    carte.appendChild(vie);
    carte.appendChild(cost);
    carte.appendChild(atk);
    carte.appendChild(mechanic);

    if (data["state"] != null)
    {
        // sleep ou pas
    }
  

    return carte;
}