function bloccaUtente(emailUtenteLoggato, emailAmico) {
    $.ajax({
        type: "POST",
        url: '../backEnd/bloccaUtente.php',
        data: {
            emailUtenteLoggato: emailUtenteLoggato,
            emailAmico, emailAmico
        },
        success: function (response) {
            console.log(response);
            location.reload();
        },
        error: function (error) {
            console.error(error);
        }
    });
}

function sbloccaUtente(emailUtenteLoggato, emailAmico) {
    $.ajax({
        type: "POST",
        url: '../backEnd/sbloccaUtente.php',
        data: {
            emailUtenteLoggato: emailUtenteLoggato,
            emailAmico, emailAmico
        },
        success: function (response) {
            console.log(response);
            location.reload();
        },
        error: function (error) {
            console.error(error);
        }
    });
}