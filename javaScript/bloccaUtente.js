function bloccaUtente(emailUtenteLoggato, emailAmico) {
    console.log(emailUtenteLoggato);

    $.ajax({
        type: "POST",
        url: '../backEnd/bloccaUtente.php',
        data: {
            emailUtenteLoggato: emailUtenteLoggato,
            emailAmico, emailAmico
        },
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.error(error);
        }
    });
}