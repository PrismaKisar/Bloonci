$(document).ready(function() {
    $('.rating-dropdown').change(function() {
        var selectedOption = $(this).find('option:selected');
        var valutazione = selectedOption.val();
        var emailMessaggio = selectedOption.data('email');
        var timestampMessaggio = selectedOption.data('timestamp');
        console.log(timestampMessaggio);
        $.ajax({
            url: 'backEnd/aggiornaValutazione.php',
            method: 'POST',
            data: { 
                valutazione: valutazione, 
                emailMessaggio: emailMessaggio,
                timestampMessaggio: timestampMessaggio
             },
            success: function(response) {
                console.log(response);
                //location.reload();
            },
            error: function(xhr, status, error) {
                console.error("no");
            }
        });
    });
});
