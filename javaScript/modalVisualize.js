
document.addEventListener("DOMContentLoaded", function () {
    var visualizeButton = document.querySelectorAll('.open-visualize-modal');
    visualizeButton.forEach(function (button) {
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

