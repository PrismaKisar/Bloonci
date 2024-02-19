$(document).ready(function () {
    $('#pubblicaButton').click(function () {
        var testo = $('#autoHeightTextarea').val();
        var tipo = $('#postType').val();
        var provincia = $('#province').val();
        var città = $('#birth_city').val();
        var file_data = $('#imageFile').prop('files')[0];
        

        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('testo', testo);
        form_data.append('tipo', tipo);
        form_data.append('provincia', provincia);
        form_data.append('città', città);

        $.ajax({
            url: 'backEnd/inserisciMessaggio.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (response) {
                console.log(response);
                //location.reload();
            },
            error: function (xhr, status, exception) {
                console.error(xhr.responseText);
            }
        });
    });
});