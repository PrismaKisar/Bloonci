
document.addEventListener("DOMContentLoaded", function () {
    var commentButtons = document.querySelectorAll('.open-comment-modal');
    commentButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var postContainer = this.closest('.post-container');
            var modal = postContainer.querySelector('.comment-modal');
            modal.style.display = 'block';
        });
    });

    var sendButtons = document.querySelectorAll('.send-comment-btn');
    sendButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var testoCommento = this.closest('.modal').querySelector('.comment-textarea').value;
            var emailMessaggio = this.getAttribute('data-email');
            var timestampMessaggio = this.getAttribute('data-timestamp');
            $.ajax({
                url: 'backEnd/inserisciCommento.php',
                method: 'POST',
                data: {
                    testoCommento: testoCommento,
                    emailMessaggio: emailMessaggio,
                    timestampMessaggio: timestampMessaggio
                },
                success: function (response) {
                    console.log('Risposta AJAX:', response);
                },
                error: function (xhr, status, error) {
                    console.error('Errore AJAX:', error);
                }
            });
            this.closest('.modal').style.display = 'none';
        });
    });
});

