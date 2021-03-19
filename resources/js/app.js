require("./bootstrap");

(() => {
    try {
        const reload = document.querySelector(".reload");
        reload.addEventListener("click", function (e) {
            window.location.reload();
        });
    } catch (err) {
        console.error(err);
    }
})();
