$(document).ready(function() {
    $('.rating-dropdown').change(function() {
        var selectedOption = $(this).find('option:selected');
        var valutazione = selectedOption.val();
        var emailMessaggio = selectedOption.data('email');
        var timestampMessaggio = selectedOption.data('timestamp');
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

$(document).ready(function() {
    $('.rating-comment-dropdown').change(function() {
        var selectedOption = $(this).find('option:selected');
        var gradimento = selectedOption.val();
        var emailGradimento = selectedOption.data('email');
        var IDCommento = selectedOption.data('idcommento');
        $.ajax({
            url: 'backEnd/aggiornaGradimento.php',
            method: 'POST',
            data: { 
                gradimento: gradimento, 
                emailGradimento: emailGradimento,
                IDCommento: IDCommento
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
