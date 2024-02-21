function autoResize() {
    const textarea = document.getElementById('autoHeightTextarea');
    //const container = document.getElementById('dynamicContainer');
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
    //container.style.height = textarea.scrollHeight + 'px';
}

function friendshipAccepted(emailUtente, emailAmico) {
    var dataToSend = {
        emailUtente: emailUtente,
        emailAmico: emailAmico
    };

    $.ajax({
        type: "POST",
        url: 'backEnd/friendshipAccepted.php',
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
        url: 'backEnd/friendshipDenied.php',
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
        url: 'backEnd/friendshipRemoved.php',
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

function postRemoved(timestamp, emailUtente) {
    var dataToSend = {
        emailUtente: emailUtente,
        timestamp: timestamp
    };

    if (window.location.pathname.includes("frontEnd")) {
        url = '../backEnd/postRemoved.php';
    } else {
        url = 'backEnd/postRemoved.php';
    }

    $.ajax({
        type: "POST",
        url: url,
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

function toggleFileInput() {
    var postType = document.getElementById("postType");
    var imageFileInput = document.getElementById("imageFile");

    if (postType.value === "foto") {
      imageFileInput.removeAttribute("hidden");
    } else {
      imageFileInput.setAttribute("hidden", "hidden");
    }
}


function commentRemoved(IDCommento) {
    var dataToSend = {
        IDCommento: IDCommento
    };

    if (window.location.pathname.includes("frontEnd")) {
        url = '../backEnd/commentRemoved.php';
    } else {
        url = 'backEnd/commentRemoved.php';
    }

    $.ajax({
        type: "POST",
        url: url,
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