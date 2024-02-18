$(document).ready(function () {
    $('#pubblicaButton').click(function () {
        var testo = $('#autoHeightTextarea').val();
        var tipo = $('#postType').val();
        console.log(tipo);
        $.ajax({
            url: 'backEnd/inserisciMessaggio.php',
            type: 'POST',
            data: {
                testo: testo,
                tipo: tipo
            },
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (xhr, status, exception) {
                console.error(xhr.responseText);
            }
        });
    });
});