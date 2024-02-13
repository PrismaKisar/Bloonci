$(document).ready(function () {
    $('#salvaModificheNomeBtn').on('click', function () {
        var nuovoNome = $('#nomeModal').val();
        var nuovoCognome = $('#cognomeModal').val();
        $.ajax({
            url: '../backEnd/salvaModificheNome.php',
            method: 'POST',
            data: {
                nome: nuovoNome,
                cognome: nuovoCognome
            },
            success: function (response) {
                console.log(response);
                location.reload();;
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});


$(document).ready(function () {
    $('#salvaModificheOrientBtn').on('click', function () {
        var nuovoOrientamento = $('#orientamentoModal').val();
        $.ajax({
            url: '../backEnd/salvaModificheOrientamento.php',
            method: 'POST',
            data: {
                orientamento: nuovoOrientamento
            },
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

$(document).ready(function () {
    $('#salvaModificheDataNascitaBtn').on('click', function () {
        var nuovaData = $('#birthModal').val();
        console.log("Nuova data di nascita:", nuovaData); // Aggiungi questo console.log per debug
        $.ajax({
            url: '../backEnd/salvaModificheDataNascita.php',
            method: 'POST',
            data: {
                dataNascita: nuovaData // Assicurati che il nome del campo corrisponda al valore che stai inviando
            },
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

