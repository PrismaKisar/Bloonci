// Attendi il caricamento del documento HTML prima di eseguire lo script
document.addEventListener("DOMContentLoaded", function () {
    // Seleziona tutti i pulsanti "Commenta" e aggiungi loro un listener di eventi
    var commentButtons = document.querySelectorAll('.open-comment-modal');
    commentButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Trova il contenitore del post più vicino
            var postContainer = this.closest('.post-container');
            // Trova il modal di commento all'interno del contenitore del post
            var modal = postContainer.querySelector('.comment-modal');
            // Mostra il modal di commento
            modal.style.display = 'block';
        });
    });

    // Seleziona tutti i pulsanti "Invia commento" e aggiungi loro un listener di eventi
    var sendButtons = document.querySelectorAll('.send-comment-btn');
    sendButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Ottieni il testo del commento inserito dall'utente
            var testoCommento = this.closest('.modal').querySelector('.comment-textarea').value;
            // Ottieni l'email e il timestamp del messaggio a cui è associato il commento
            var emailMessaggio = this.getAttribute('data-email');
            var timestampMessaggio = this.getAttribute('data-timestamp');
            var IDMessaggio = this.closest('.modal').querySelector('.reference-dropdown').value;
            // Effettua una richiesta AJAX per inviare il commento al backend


            if (window.location.pathname.includes("frontEnd")) {
                url = '../backEnd/inserisciCommento.php';
            } else {
                url = 'backEnd/inserisciCommento.php';
            }
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    testoCommento: testoCommento,
                    emailMessaggio: emailMessaggio,
                    timestampMessaggio: timestampMessaggio,
                    IDMessaggio: IDMessaggio
                },
                // Gestisci la risposta dal backend
                success: function (response) {
                    console.log(response); // Log della risposta per debug
                    //location.reload(); // Ricarica la pagina dopo l'inserimento del commento
                },
                // Gestisci eventuali errori nella richiesta AJAX
                error: function (xhr, status, error) {
                    console.error(error); // Log degli errori per debug
                }
            });
            // Nascondi il modal di commento dopo l'invio del commento
            this.closest('.modal').style.display = 'none';
        });
    });
});

