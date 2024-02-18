document.addEventListener("DOMContentLoaded", function () {
    // Controlla se ci sono errori nei parametri GET
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const errorMessageElement = document.getElementById('error-message');

    if (error === 'exists') {
        errorMessageElement.innerText = "Questa email è già registrata";
    } else if (error === 'registration_failed') {
        errorMessageElement.innerText = "Errore durante la registrazione, riprova più tardi.";
    } else if (error === 'underage') {
        errorMessageElement.innerText = "L'utente deve avere più di 18 anni.";
    }
});
