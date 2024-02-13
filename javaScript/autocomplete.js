document.addEventListener("DOMContentLoaded", function() {

    let availableKeywords = [];

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "backEnd/getNames.php?q=", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            availableKeywords = JSON.parse(xhr.responseText);
        }
    };
    xhr.send();

    const resultBox = document.querySelector(".result-box");
    const inputBox = document.getElementById("input-box");


    inputBox.onkeyup = function(){
        let result = [];
        let input = inputBox.value;
    
        if (input.length) {
            result = availableKeywords.filter((item) => {
                return item.nome_completo.toLowerCase().includes(input.toLowerCase());
            });
            display(result);
        } else {
            resultBox.innerHTML = '';
        }
    };

    function display(result) {
        const content = result.map((item) => {
            if (item.stato_amicizia === 'amico') {
                return `<li>
                            <a href="frontEnd/bachecaAmico.php?emailCorrente=${item.email}" id="redirectToPageWithInfo">    
                            <div class="name">${item.nome_completo}</div></a>
                            <div class="friend-status amico">amico</div>
                        </li>`;
            } else if (item.stato_amicizia === 'non amico') {
                return `<li>
                            <a href="frontEnd/bachecaAmico.php?emailCorrente=${item.email}" id="redirectToPageWithInfo">    
                            <div class="name">${item.nome_completo}</div></a>
                            <button class="request-button" onclick="sendRequest('${item.email}')">richiedi</button>
                        </li>`;
            } else if (item.stato_amicizia === 'inviata') {
                return `<li>
                            <a href="frontEnd/bachecaAmico.php?emailCorrente=${item.email}" id="redirectToPageWithInfo">    
                            <div class="name">${item.nome_completo}</div></a>
                            <div class="friend-status inviata">inviata</div>
                        </li>`;
            } else {
                return `<li>
                            <a href="frontEnd/bachecaAmico.php?emailCorrente=${item.email}" id="redirectToPageWithInfo">    
                            <div class="name">${item.nome_completo}</div></a>
                            <button class="accept-button" onclick="friendshipAccepted('${item.email_sessione}','${item.email}')">accetta</button>
                        </li>`;
            }
        });
    
        if (content.length !== 0) {
            resultBox.innerHTML = `<ul>${content.join('')}</ul>`;
        } else {
            resultBox.innerHTML = '';
        }
    } 
});

function sendRequest(emailRicevente) {
    // Effettua una richiesta AJAX per inviare la richiesta di amicizia
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "backEnd/sendRequest.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Puoi gestire la risposta della richiesta qui se necessario
            console.log(xhr.responseText);
        }
    };

    // Invia i dati necessari
    const data = `emailRicevente=${encodeURIComponent(emailRicevente)}`;
    xhr.send(data);
    location.reload();
}

