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
            let reels = response.data.reels;
            let i = 1;
            let items = [];
            reels.forEach(function (reel, j) {
                reel.forEach(function (img, k) {
                    document.getElementById("item" + i++).src = reels[j][k];
                    items.push(reels[j][k]);
                });
            });
            paylines.forEach(payline => {
                matchline = [];
                payline.forEach(i => {
                    matchline.push(items[i - 1]);
                });
                const counts = {};
                for (const num of matchline) {
                    counts[num] = counts[num] ? counts[num] + 1 : 1;
                    if (counts[num] >= 3) {
                        console.log(payline);
                        console.log(num);
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
