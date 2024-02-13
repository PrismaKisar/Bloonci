function init() {
    var btnNome = document.getElementById("openModalBtnNome");
    var btnCognome = document.getElementById("openModalBtnCognome");
    var btnDataNascita = document.getElementById("openModalBtnDataNascita");
    var btnCittà = document.getElementById("openModalBtnCittà");
    var btnProvincia = document.getElementById("openModalBtnProvincia");
    var btnOrientamento = document.getElementById("openModalBtnOrientamento");

    var modalNome = document.getElementById("modalNome");
    var modalDataNascita = document.getElementById("modalDataNascita")
    var modalLuogo = document.getElementById("modalLuogoNascita")
    var modalOrientamento = document.getElementById("modalOrientamento")

    btnNome.onclick = function () { modalNome.style.display = "block"; }
    btnCognome.onclick = function () { modalNome.style.display = "block"; }
    btnDataNascita.onclick = function () { modalDataNascita.style.display = "block"; }
    btnCittà.onclick = function () { modalLuogo.style.display = "block"; }
    btnProvincia.onclick = function () { modalLuogo.style.display = "block"; }
    btnOrientamento.onclick = function () { modalOrientamento.style.display = "block"; }

    window.onclick = function (event) {
        if (event.target == modalNome) { modalNome.style.display = "none"; }
        if (event.target == modalDataNascita) { modalDataNascita.style.display = "none"; }
        if (event.target == modalLuogo) { modalLuogo.style.display = "none"; }
        if (event.target == modalOrientamento) { modalOrientamento.style.display = "none"; }
    }
}

document.addEventListener("DOMContentLoaded", function() {
    init();
});
