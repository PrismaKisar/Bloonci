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
        var nuovoOrientamento = $('#birthModal').val();
        $.ajax({
            url: '../backEnd/salvaModificheDataNascita.php',
            method: 'POST',
            data: {
                orientamento: nuovoOrientamento
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
