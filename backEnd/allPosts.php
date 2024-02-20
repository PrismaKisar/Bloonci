<?php
// Includi il file di connessione al database
require "dbConnection.php";

// Inizia la sessione
session_start();

// Funzione per ottenere i commenti di un messaggio
function getCommenti($emailMessaggio, $timestampMessaggio, $cid)
{
    // Query per selezionare i commenti relativi al messaggio specificato
    $query = "SELECT * FROM commento WHERE emailMessaggio = '$emailMessaggio' AND timestampMessaggio = '$timestampMessaggio'";
    $result = $cid->query($query);
    return $result;
}

// Funzione per stampare i commenti
function printCommenti($resultCommenti, $cid)
{
    // Verifica se ci sono commenti presenti nel risultato della query
    if ($resultCommenti->num_rows > 0) {
        // Loop attraverso ogni commento e stampalo
        while ($row = $resultCommenti->fetch_assoc()) {
            $testo = $row['testo'];
            $emailTemp = $row['emailMessaggio'];
            // Ottieni il nome e il cognome dell'utente che ha commentato
            $res = $cid->query("SELECT nome, cognome FROM utente WHERE email = '$emailTemp'");
            $row3 = $res->fetch_assoc();
            $nome = $row3['nome'];
            $cognome = $row3['cognome'];

            // Stampare il commento
            echo <<<END
            <div class="post-container">
                <div class="user-profile">
                  <div class="name-post">
                    <p><a href=>$nome $cognome</a></p>
                  </div>
                </div>
                <p class="post-text">$testo</p>
                <div class="post-footer">
                <select class="rating-dropdown">
                    <option disabled selected hidden>si</option>
                    <option value="-3">-3</option>
                    <option value="-2">-2</option>
                    <option value="-1">-1</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            </div>
            END;
        }
    }
}

// Query per selezionare i messaggi dell'utente corrente e dei suoi amici
$query = "SELECT m.*, u.nome AS nome_amico, u.cognome AS cognome_amico
          FROM messaggio AS m
          JOIN utente AS u ON m.email = u.email
          WHERE m.email IN (
              SELECT emailRicevitore FROM amicizia WHERE emailRichiedente = '$emailUtenteLoggato'
              UNION
              SELECT emailRichiedente FROM amicizia WHERE emailRicevitore = '$emailUtenteLoggato'
              UNION
              SELECT '$emailUtenteLoggato'
          )
          ORDER BY m.timestamp DESC;";

// Esegui la query
$result = $cid->query($query);

// Verifica se ci sono messaggi presenti nel risultato della query
if ($result->num_rows > 0) {
    // Loop attraverso ogni messaggio e stampalo
    while ($row = $result->fetch_assoc()) {
        $testo = $row['testo'];
        $email = $row['email'];
        $timestamp = $row['timestamp'];
        $tipo = $row['tipo'];
        $nomeAmico = $row['nome_amico'];
        $cognomeAmico = $row['cognome_amico'];

        // Ottieni i commenti per il messaggio corrente
        $resultCommenti = getCommenti($email, $timestamp, $cid);

        // Verifica se l'utente ha già valutato il post
        $queryValutazione = "SELECT valutazione FROM valuta WHERE emailMessaggio = '$email' AND emailValutazione = '$emailUtenteLoggato' AND timestampMessaggio = '$timestamp'";
        $resultValutazione = $cid->query($queryValutazione);
        $selezione = "Valuta";
        if ($resultValutazione->num_rows > 0) {
            $rowValutazione = $resultValutazione->fetch_assoc();
            $selezione = $rowValutazione['valutazione'];
        }

        // Stampa il post
        echo <<<END
            <div class='post-container'>
            <div class='user-profile'>
                <img src='images/misc/unkwownPhoto.jpeg'>
                <div class='name-post'>
                    <p><a href='frontEnd/bachecaAmico.php?emailCorrente=$email'>$nomeAmico $cognomeAmico</a></p>
                    <small>$timestamp</small>
                </div>
            </div>
            <p class='post-text'>$testo</p>
            END;

        // Stampa l'immagine se il tipo è "foto"
        if ($tipo == "foto") {
            $nome = $row['nome'];
            $percorso = $row['percorso'];
            echo "<img src='$percorso$nome' class='post-img'>";
        }

        // Stampa il footer del post
        echo <<<END
            <div class="post-footer">
                <select class="rating-dropdown">
                    <option disabled selected hidden>$selezione</option>
                    <option value="-3" data-email="$email" data-timestamp="$timestamp">-3</option>
                    <option value="-2" data-email="$email" data-timestamp="$timestamp">-2</option>
                    <option value="-1" data-email="$email" data-timestamp="$timestamp">-1</option>
                    <option value="0" data-email="$email" data-timestamp="$timestamp">0</option>
                    <option value="1" data-email="$email" data-timestamp="$timestamp">1</option>
                    <option value="2" data-email="$email" data-timestamp="$timestamp">2</option>
                    <option value="3" data-email="$email" data-timestamp="$timestamp">3</option>
                </select>
                <button class="open-comment-modal">Commenta</button>
                <button class="open-visualize-modal">Guarda commenti</button>
            </div>

            <!-- Modal per inserire un commento -->
            <div class="modal comment-modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Commenta questo post</h5>
                        </div>
                        <div class="modal-body">
                            <textarea class="comment-textarea" rows="4" cols="50" placeholder="Commenta..."></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="close-btn" type="button">Chiudi</button>
                            <button class="send-comment-btn" type="button" data-email="$email" data-timestamp="$timestamp">Invia commento</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal per visualizzare i commenti -->
            <div class="modal visualize-modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tutti i commenti</h5>
                        </div>
                        <div class="modal-body">
        END;

        // Stampa tutti i commenti per il messaggio corrente
        printCommenti($resultCommenti, $cid);

        echo <<<END
                        </div>
                        <div class="modal-footer">
                            <button class="close-btn" type="button">Chiudi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        END;
    }
} else {
    // Messaggio di avviso se non ci sono post trovati
    echo "Nessun post trovato.";
}