$(document).ready(function() {
    $('.rating-dropdown').change(function() {
        var selectedOption = $(this).find('option:selected');
        var valutazione = selectedOption.val();
        var emailMessaggio = selectedOption.data('email');
        var timestampMessaggio = selectedOption.data('timestamp');
        if (window.location.pathname.includes("frontEnd")) {
            url = '../backEnd/aggiornaValutazione.php';
        } else {
            url = 'backEnd/aggiornaValutazione.php';
        }

        
        $.ajax({
            url: url,
            method: 'POST',
            data: { 
                valutazione: valutazione, 
                emailMessaggio: emailMessaggio,
                timestampMessaggio: timestampMessaggio
             },
            success: function(response) {
                console.log(response);
                location.reload();
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
        if (window.location.pathname.includes("frontEnd")) {
            url = '../backEnd/aggiornaGradimento.php';
        } else {
            url = 'backEnd/aggiornaGradimento.php';
        }
        $.ajax({
            url: url,
            method: 'POST',
            data: { 
                gradimento: gradimento, 
                emailGradimento: emailGradimento,
                IDCommento: IDCommento
             },
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("no");
            }
        });
    });
});
