$(document).ready(function () {
    $('#pubblicaButton').click(function () {
        var testo = $('#autoHeightTextarea').val();
        $.ajax({
            url: 'backEnd/inserisciMessaggio.php',
            type: 'POST',
            data: {
                testo: testo
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