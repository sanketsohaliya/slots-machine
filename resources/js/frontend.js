const { default: axios } = require("axios");


const spin = document.getElementById("spin");
var url = spin.getAttribute('data-url');
spin.addEventListener("click", function () {
    axios.get(url)
        .then(function (response) {
            let reels = response.data.reels;
            let i = 1;
            reels.forEach(function (reel, j) {
                reel.forEach(function (img, k) {
                    document.getElementById("slot" + i++).src = reels[j][k];
                });
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
});
