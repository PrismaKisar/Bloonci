document.addEventListener("DOMContentLoaded", function () {
    // Controlla se ci sono errori nei parametri GET
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const errorMessageElement = document.getElementById('error-message');

    if (error === 'loginerror') {
        errorMessageElement.innerText = "Email o Password non corretti";
    } 

});
