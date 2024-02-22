function autoResize() {
    const textarea = document.getElementById('autoHeightTextarea');
    const container = document.getElementById('dynamicContainer');
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
    container.style.height = textarea.scrollHeight + 'px';
}

function friendshipAccepted(emailUtente, emailAmico) {
    var dataToSend = {
        emailUtente: emailUtente,
        emailAmico: emailAmico
    };

    $.ajax({
        type: "POST",
        url: '../backEnd/friendshipAccepted.php',
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

function friendshipDenied(emailUtente, emailAmico) {
    var dataToSend = {
        emailUtente: emailUtente,
        emailAmico: emailAmico
    };

    $.ajax({
        type: "POST",
        url: '../backEnd/friendshipDenied.php',
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

function friendshipRemoved(emailUtente, emailAmico) {
    var dataToSend = {
        emailUtente: emailUtente,
        emailAmico: emailAmico
    };

    $.ajax({
        type: "POST",
        url: '../backEnd/friendshipRemoved.php',
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