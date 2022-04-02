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
    var elements = document.getElementsByClassName('cell-border');
    while (elements.length > 0) {
        elements[0].classList.remove('cell-border');
    }
    axios.get(url)
        .then(function (response) {
            let reels = response.data.reels;
            let i = 1;
            let items = [];
            reels.forEach(function (reel, j) {
                reel.forEach(function (img, k) {
                    document.getElementById("item" + i++).src = reels[j][k];
                    items.push(reels[j][k]);
                });
            });
            let won = false;
            paylines.forEach(payline => {
                let matchline = [];
                payline.forEach(i => {
                    matchline.push(items[i - 1]);
                });
                const counts = {};
                for (const num of matchline) {
                    counts[num] = counts[num] ? counts[num] + 1 : 1;
                    if (counts[num] >= 3 && won === false) {
                        won = true;
                        payline.forEach(i => {
                            let slot = document.getElementById("slot" + i);
                            slot.classList.add("cell-border");
                        });
                        showMessage();
                    }
                }
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
});

function showMessage() {
    const msg = document.getElementById("message");
    msg.style.display = "block";
    msg.classList.add('animated', 'pulse')
}

function hideMessage() {
    const msg = document.getElementById("message");
    msg.style.display = "none";
}
