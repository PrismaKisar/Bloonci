
document.addEventListener("DOMContentLoaded", function () {
    var commentButtons = document.querySelectorAll('.open-visualize-modal');
    commentButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var postContainer = this.closest('.post-container');
            var modal = postContainer.querySelector('.visualize-modal');
            modal.style.display = 'block';
        });
    });

    var sendButtons = document.querySelectorAll('.close-btn');
    sendButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
        });
    });
});

