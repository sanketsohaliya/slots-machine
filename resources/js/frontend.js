const { default: axios } = require("axios");


const spin = document.getElementById("spin");
let url = spin.getAttribute('data-url');
let paylines = [
    [1, 2, 3, 4, 5],
    [6, 7, 8, 9, 10],
    [11, 12, 13, 14, 15],
    [1, 7, 13, 9, 5],
    [11, 7, 3, 9, 15],
    [6, 2, 3, 4, 10],
    [6, 12, 13, 14, 10],
    [1, 2, 8, 14, 15],
    [11, 12, 8, 4, 5]
];
spin.addEventListener("click", function () {
    hideMessage();
    axios.get(url)
        .then(function (response) {
            let remaining_spins = response.data.remaining_spins;
            if (remaining_spins > 0) {
                var elements = document.getElementsByClassName('cell-border');
                while (elements.length > 0) {
                    elements[0].classList.remove('cell-border');
                }
                let reels = response.data.reels;
                let weights = response.data.weights;
                let symbols = response.data.symbols;
                let i = 1;
                let items = [];
                reels.forEach(function (reel, j) {
                    reel.forEach(function (img, k) {
                        document.getElementById("item" + i++).src = "/images/symbols/" + reels[j][k];
                        items.push(reels[j][k]);
                    });
                });
                let won = false;
                showMessage("Try again! You have " + remaining_spins + " spins left.");
                paylines.forEach(payline => {
                    let matchline = [];
                    payline.forEach(i => {
                        matchline.push(items[i - 1]);
                    });
                    const counts = {};
                    let points = 0;
                    matchline.forEach(function (symbol, matchIndex) {
                        counts[symbol] = counts[symbol] ? counts[symbol] + 1 : 1;
                        if (counts[symbol] = 3 && won === false) {
                            if (matchline[matchIndex - 1] === symbol && matchline[matchIndex - 2] === symbol) {
                                let weight = weights[symbols.indexOf(symbol)];
                                console.log(weight);
                                points = weight[0];
                                if (matchline[matchIndex + 1] === symbol) {
                                    points = weight[1];
                                    if (matchline[matchIndex + 2] === symbol) {
                                        points = weight[2];
                                    }
                                }
                                won = true;
                                payline.forEach(j => {
                                    let slot = document.getElementById("slot" + j);
                                    slot.classList.add("cell-border");
                                });
                                hideMessage();
                                showMessage('Yay! You Won ' + points + ' Points...');
                            }
                        }
                    });
                });
            }
            else {
                showMessage("You don't have any spins left! Come again tomorrow...");
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
});

function showMessage(text) {
    const msg = document.getElementById("message");
    msg.innerHTML = text;
    msg.style.display = "block";
}

function hideMessage() {
    const msg = document.getElementById("message");
    msg.style.display = "none";
}
