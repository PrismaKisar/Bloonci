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
    $('#salvaModificheLuogoBtn').on('click', function () {
        var nuovaProvincia = $('#province').val();
        var nuovaCittà = $('#birth_city').val();
        $.ajax({
            url: '../backEnd/salvaModificheLuogo.php',
            method: 'POST',
            data: {
                provincia: nuovaProvincia,
                città: nuovaCittà
            },
            success: function (response) {
                console.log(response);
                //location.reload();
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
        $.ajax({
            url: '../backEnd/salvaModificheDataNascita.php',
            method: 'POST',
            data: {
                dataNascita: nuovaData
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
    $('#aggiungiHobbyBtn').on('click', function () {
        var nuovoHobby = $('#hobbyModal').val();
        $.ajax({
            url: '../backEnd/aggiungiHobby.php',
            method: 'POST',
            data: {
                hobby: nuovoHobby
            },
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(error);
                location.reload();
            }
        });
    });
});

