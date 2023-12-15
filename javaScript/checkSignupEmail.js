document.addEventListener("DOMContentLoaded", function () {
    // Controlla se ci sono errori nei parametri GET
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const errorMessageElement = document.getElementById('error-message');

    if (error === 'exists') {
        // Imposta il messaggio di errore
        errorMessageElement.innerText = "Questa email è già registrata";
    } else if (error === 'registration_failed') {
        // Imposta il messaggio di errore per la registrazione fallita (se necessario)
        errorMessageElement.innerText = "Errore durante la registrazione, riprova più tardi.";
    }
});
