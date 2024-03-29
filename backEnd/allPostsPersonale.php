<?php
// Includi il file per la connessione al database
require "dbConnection.php";

function everyFriendPost($cid)
{
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT IDMessaggio 
    FROM messaggio 
    WHERE email IN (
    SELECT utente.email
    FROM amicizia
    INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
    OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
    UNION
    SELECT '$emailUtenteLoggato' AS email)";
    $result = $cid->query($sql);

    echo "<select class='reference-dropdown'>";
    echo "<option value='' selected>Referisciti</option>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idMessaggio = $row["IDMessaggio"];
            echo "<option value='$idMessaggio'>$idMessaggio</option>";
        }
    }
    echo "</select>";
}

// Funzione per ottenere i commenti relativi a un determinato messaggio
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
            $emailTemp = $row['emailCommento'];
            $IDCommento = $row['IDCommento'];
            $IDMessaggio = $row['IDMessaggio'];
            $emailUtenteLoggato = $_SESSION['email'];
            $res = $cid->query("SELECT indiceGradimento FROM gradimento WHERE emailGradimento='$emailUtenteLoggato' AND idcommento='$IDCommento'");
            if ($res->num_rows > 0) {
                $row3 = $res->fetch_assoc();
                $selezione = $row3['indiceGradimento'];
            } else {
                $selezione = "gradimento";
            }

            // Ottieni il nome e il cognome dell'utente che ha commentato
            $res = $cid->query("SELECT nome, cognome FROM utente WHERE email = '$emailTemp'");
            $row3 = $res->fetch_assoc();
            $nome = $row3['nome'];
            $cognome = $row3['cognome'];


            // Stampare il commento
            echo <<<END
            <div class="post-container">
                <div class="user-profile">
                  <div class="name-post" style="display: flex;">
                    <p style="padding-right: 10px;"><a href=>$nome $cognome </a></p>
            END;

            if (!is_null($IDMessaggio)) {
                echo <<<END
                        <p style="font-weight: 300;"> si riferisce al messaggio</p>
                        <p style="padding-left: 10px;"><button class="gradisce-btn" onclick='referenceMessage({$IDMessaggio})'>$IDMessaggio</button>
                        END;
            }
            echo "</div>";


            if ($emailTemp == $emailUtenteLoggato) {
                echo "<button class=remove-btn onclick='commentRemoved(\"{$IDCommento}\")'>rimuovi</button>";
            }

            echo <<<END
                  
                </div>
                <p class="post-text">$testo</p>
                <div class="post-footer">
                <select class="rating-comment-dropdown">
                <option disabled selected hidden>$selezione</option>
                <option data-IDCommento="$IDCommento" data-email="$emailUtenteLoggato" value="3">3</option>
                <option data-IDCommento="$IDCommento" data-email="$emailUtenteLoggato" value="2">2</option>
                <option data-IDCommento="$IDCommento" data-email="$emailUtenteLoggato" value="1">1</option>
                <option data-IDCommento="$IDCommento" data-email="$emailUtenteLoggato" value="0">0</option>
                <option data-IDCommento="$IDCommento" data-email="$emailUtenteLoggato" value="-1">-1</option>
                <option data-IDCommento="$IDCommento" data-email="$emailUtenteLoggato" value="-2">-2</option>
                <option data-IDCommento="$IDCommento" data-email="$emailUtenteLoggato" value="-3">-3</option>
                </select>
            </div>
            </div>
            END;
        }
    }
}

// Ottieni l'email dell'utente loggato
$emailUtenteLoggato = $_SESSION['email'];

// Query per selezionare i messaggi dell'utente corrente
$query = "SELECT m.*, u.nome AS nome_amico, u.cognome AS cognome_amico, IDMessaggio
          FROM messaggio AS m
          JOIN utente AS u ON m.email = u.email
          WHERE m.email = '$emailUtenteLoggato' 
          ORDER BY m.timestamp DESC";

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
        $città = $row['città'];
        $provincia = $row['provincia'];
        $IDMessaggio = $row['IDMessaggio'];

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
                <div style="display: flex">
                <img src='../images/misc/unkwownPhoto.jpeg'>
                <div class='name-post'>
                    <p><a href='frontEnd/bachecaAmico.php?emailCorrente=$email'>$nomeAmico $cognomeAmico</a></p>
                    <small>id del messaggio: $IDMessaggio - data: $timestamp

            END;


        if (!is_null($città) && !is_null($provincia)) {
            echo <<<END
                - luogo: $città ($provincia)</small></div>
                </div>
            END;
        } else {
            echo "</small></div></div>";
        }

        if ($email == $emailUtenteLoggato) {
            echo "<div><button class=remove-btn onclick='postRemoved(\"{$timestamp}\", \"{$email}\")'>rimuovi</button></div>";
        }

        echo <<<END
            </div>
            <p class='post-text'>$testo</p>
            END;

        // Stampa l'immagine se il tipo è "foto"
        if ($tipo == "foto") {
            $nome = $row['nome'];
            $percorso = $row['percorso'];
            echo "<img src='../$percorso$nome' class='post-img'>";
        }

        // Stampa il footer del post
        echo <<<END
            <div class="post-footer">
                <select class="rating-dropdown">
                <option disabled selected hidden>$selezione</option>
                <option value="3" data-email="$email" data-timestamp="$timestamp">3</option>
                <option value="2" data-email="$email" data-timestamp="$timestamp">2</option>
                <option value="1" data-email="$email" data-timestamp="$timestamp">1</option>
                <option value="0" data-email="$email" data-timestamp="$timestamp">0</option>
                <option value="-1" data-email="$email" data-timestamp="$timestamp">-1</option>
                <option value="-2" data-email="$email" data-timestamp="$timestamp">-2</option>
                <option value="-3" data-email="$email" data-timestamp="$timestamp">-3</option>
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


            END;
        everyFriendPost($cid);
        echo <<<END
                            
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
    echo "Nessun post trovato per l'email specificata.";
}
