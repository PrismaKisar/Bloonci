$(document).ready(function () {
    $('#salvaModificheBtn').on('click', function () {
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
