$(document).ready(function () {
    // Quando viene cliccato un pulsante "commenta"
    $('.commentaButton').on('click', function () {
        console.log('Pulsante "commenta" cliccato');
        
        // Trova il modal genitore del pulsante cliccato
        var modal = $(this).closest('.post-container').find('.modal');
        console.log('Modal trovato:', modal);
        
        // Imposta lo stile CSS per visualizzare il modal
        modal.css('display', 'block');
        
        // Imposta i dati nel pulsante inviaCommento del modal
        var emailMessaggio = $(this).data('email');
        var timestampMessaggio = $(this).data('timestamp');
        console.log('Email messaggio:', emailMessaggio);
        console.log('Timestamp messaggio:', timestampMessaggio);
        
        $('.modal-footer #inviaCommento').data('email', emailMessaggio);
        $('.modal-footer #inviaCommento').data('timestamp', timestampMessaggio);
    });

    // Invio del commento tramite AJAX
    $('#inviaCommento').on('click', function () {
        console.log('Pulsante "Invia commento" cliccato');
        
        var testoCommento = $('#commentoModal').val();
        var emailMessaggio = $(this).data('email');
        var timestampMessaggio = $(this).data('timestamp');
        console.log('Testo commento:', testoCommento);
        console.log('Email messaggio:', emailMessaggio);
        console.log('Timestamp messaggio:', timestampMessaggio);
        
        $.ajax({
            url: 'backEnd/inserisciCommento.php',
            method: 'POST',
            data: {
                testoCommento: testoCommento,
                emailMessaggio: emailMessaggio,
                timestampMessaggio: timestampMessaggio
            },
            success: function (response) {
                console.log('Risposta AJAX:', response);
                $('.commentModal').css('display', 'none');
            },
            error: function (xhr, status, error) {
                console.error('Errore AJAX:', error);
            }
        });
    });
});
