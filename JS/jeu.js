const applyStyles = (iframe) => {
    let styles = {
        fontColor: "white",
        fontGoogleName: "Gruppo",
        height: "100%",
        fontSize: "20px",
        inputBackgroundColor: "rgba(0, 0, 0, 0.8)",
    };

    setTimeout(() => {
        iframe.contentWindow.postMessage(JSON.stringify(styles), "*");
    }, 100);
};

const state = () => {
    fetch("JeuAjax.php", {
        // Il faut créer cette page et son contrôleur appelle
        method: "POST", // l’API (games/state)
        credentials: "include",
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (typeof data !== "object") {
                if (data == "GAME_NOT_FOUND") {
                    // Fin de la partie. Est-ce que j’ai gagné? Je dois appeler user-info
                    alert("Probleme avec la partie, retour au lobby");
                    setTimeout(function () {
                        window.location.href = "./lobby.php";
                    }, 2000);
                }
                if (data == "WAITING") {
                    alert("En attente de joueur");
                }
                if (data == "LAST_GAME_LOST") {
                    // surrender
                    alert("Tu a perdu la partie");
                    setTimeout(function () {
                        window.location.href = "./lobby.php";
                    }, 2000);
                }
                if (data == "LAST_GAME_WON") {
                    alert("tu a gagner la partie!!!");
                    setTimeout(function () {
                        window.location.href = "./lobby.php";
                    }, 2000);
                }
            } else {
                DisplayData(data);
            }

            setTimeout(state, 1000); // Attendre 1 seconde avant de relancer l’appel
        });
};

window.addEventListener("load", () => {
    setTimeout(state, 1000); // Appel initial (attendre 1 seconde)
    document.querySelector("#Turn").addEventListener("click", turn);
    document.querySelector("#hpower").addEventListener("click", power);
    document.querySelector("#giveup").addEventListener("click", giveup);

    document.querySelector("#EnemieHero").addEventListener("click", attack);
});

function turn() {
    button("end");
}
function power() {
    button("hero");
}
function giveup() {
    button("surrender");
}

function chat() {
    // fait apparaitre et disparaitre le chat
}

const button = (type) => {
    let formData = new FormData();
    formData.append("typebutton", type);
    console.log(type);
    fetch("JeuButtonAjax.php", {
        // Il faut créer cette page et son contrôleur appelle

        method: "POST", // l’API (games/state)
        credentials: "include",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (typeof data !== "object") {
            } else {
            }
        });
};

const carte = (type, id, idtarget = null) => {
    // idtarget a null si play
    let formData = new FormData();
    formData.append("typecarte", type);
    formData.append("carte", id);
    formData.append("target", idtarget);
    fetch("JeuCartAjax.php", {
        // Il faut créer cette page et son contrôleur appelle

        method: "POST", // l’API (games/state)
        credentials: "include",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
        });
};

function DisplayData(data) {
    UpdatePlayerStats(data);
    UpdateEnemieStats(data);
    UpdateButton(data);
    UpdateCardEnemie(data);
    UpdateCardPlayer(data);
    UpdateBoardPlayer(data);
    UpdateBoardEnemie(data);

    document.querySelector("#timer").textContent = data["remainingTurnTime"];
}

function UpdatePlayerStats(data) {
    document.querySelector("#ViePlayer").textContent = data["hp"];
    document.querySelector("#energiePlayer").textContent = data["mp"];
    document.querySelector("#nbcartme").textContent = data["remainingCardsCount"];
}

function UpdateButton(data) {
    document.querySelector("#Turn").disabled = !data["yourTurn"];
    if (!data["yourTurn"] && data["heroPowerAlreadyUsed"])
        document.querySelector("#hpower").disabled = true;
    else document.querySelector("#hpower").disabled = false;
}

function UpdateEnemieStats(data) {
    document.querySelector("#VieEnemie").textContent = data["opponent"]["hp"];
    document.querySelector("#energieEnemie").textContent = data["opponent"]["mp"];
    document.querySelector("#nbcartenemie").textContent = data["opponent"]["remainingCardsCount"];
}

function UpdateBoardPlayer(data) {
    let boardplayer = document.querySelector("#board-player");
    while (boardplayer.firstChild) {
        boardplayer.removeChild(boardplayer.firstChild);
    }
    for (let i = 0; i < data["board"].length; i++) {
        boardplayer.appendChild(AddCartBoardPlayer(data["board"][i]));
    }
}

function UpdateBoardEnemie(data) {
    let boardenemie = document.querySelector("#board-enemie");
    while (boardenemie.firstChild) {
        boardenemie.removeChild(boardenemie.firstChild);
    }
    for (let i = 0; i < data["opponent"]["board"].length; i++) {
        boardenemie.appendChild(AddCartBoardEnemie(data["opponent"]["board"][i]));
    }
}

function UpdateCardEnemie(data) {
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
    if (data["opponent"]["handSize"] < 5) {
        for (let i = 0; i < data["opponent"]["handSize"]; i++) {
            leftenemie.appendChild(cartenemie);
        }
    } else {
        for (let i = 0; i <= 5; i++) {
            leftenemie.appendChild(cartenemie);
        }
        for (let i = 5; i < data["opponent"]["handSize"]; i++) {
            rightenemie.appendChild(cartenemie);
        }
    }
}

function UpdateCardPlayer(data) {
    let leftplayer = document.querySelector("#player-left");
    let rightplayer = document.querySelector("#player-right");
    while (leftplayer.firstChild) {
        leftplayer.removeChild(leftplayer.firstChild);
    }
    while (rightplayer.firstChild) {
        rightplayer.removeChild(rightplayer.firstChild);
    }

    if (data["hand"].length <= 5) {
        for (let i = 0; i < data["hand"].length; i++) {
            leftplayer.appendChild(addplayerhandcart(data["hand"][i]));
        }
    } else {
        for (let i = 0; i < 5; i++) {
            leftplayer.appendChild(addplayerhandcart(data["hand"][i]));
        }
        for (let i = 5; i < data["hand"].length; i++) {
            rightplayer.appendChild(addplayerhandcart(data["hand"][i]));
            console.log(data["hand"][i]);
        }
    }
}

function addplayerhandcart(data) {
    let card = AddCard(data);
    card.addEventListener("click", play);
    return card;
}

function AddCard(data) {
    var carte = document.createElement("div");
    carte.className = "Card";
    var div1 = document.createElement("div");

    var cost = document.createElement("span");
    cost.textContent = data["cost"];

    var div2 = document.createElement("div");
    var vie = document.createElement("span");
    vie.textContent = data["hp"];
    var atk = document.createElement("span");
    atk.textContent = data["atk"];

    div2.appendChild(atk);
    div2.appendChild(vie);
    div1.appendChild(cost);
    div1.appendChild(div2);

    var mechanic = document.createElement("span");
    mechanic.textContent = data["mechanics"];
    var uid = document.createElement("span");
    uid.textContent = data["uid"];
    uid.classList.add("uid");

    carte.appendChild(div1);
    carte.appendChild(mechanic);
    carte.appendChild(uid);

    return carte;
}

let attaquant;

function AddCartBoardPlayer(data) {
    let card = AddCard(data);
    card.addEventListener("click", addatackant);
    return card;
}

function AddCartBoardEnemie(data) {
    let card = AddCard(data);
    card.addEventListener("click", attack);
    return card;
}

function play() {
    let target = event.currentTarget;
    console.log(target.querySelector(".uid").textContent);
    carte("play", target.querySelector(".uid").textContent);
}

function addatackant() {
    let target = event.currentTarget;
    attaquant = target.querySelector(".uid").textContent;
}

function attack() {
    let target = event.currentTarget;
    if (attaquant != null) {
        carte("attack", attaquant, target.querySelector(".uid").textContent);
    }
}
