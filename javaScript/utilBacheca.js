function autoResize() {
    const textarea = document.getElementById('autoHeightTextarea');
    const container = document.getElementById('dynamicContainer');
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
    container.style.height = textarea.scrollHeight + 'px';
}

function hobbyRemoved(hobby) {
    var dataToSend = {
        hobby: hobby
    };

    $.ajax({
        type: "POST",
        url: '../backEnd/hobbyRemoved.php',
        data: dataToSend,
        success: function(response) {
            console.log(response);
            location.reload();
        },
        error: function(error) {
            console.error(error);
        }
    });
}

function eliminaUtente(emailAmico) {
    var dataToSend = {
        emailAmico
    };

    $.ajax({
        type: "POST",
        url: "../backEnd/eliminaUtente.php",
        data: dataToSend,
        success: function(response) {
            console.log(response);
            location.reload();
        },
        error: function(error) {
            console.error(error);
        }
    });
}