document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById("openCommentModal");
    var modal = document.getElementById("commentModal");
    button.onclick = function () { modal.style.display = "block"; }
    window.onclick = function (event) {
        if (event.target == modal) { modal.style.display = "none"; }
    }
});