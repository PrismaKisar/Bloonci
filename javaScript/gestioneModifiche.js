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
    $('#salvaModificheDataNascitaBtn').on('click', function () {
        var nuovaDataNascita = $('#birthModal').val();
        $.ajax({
            url: '../backEnd/salvaModificheDataNascita.php',
            method: 'POST',
            data: {
                dataNascita: nuovaDataNascita
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
