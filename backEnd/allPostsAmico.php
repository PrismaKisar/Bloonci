<?php
require "dbConnection.php";
session_start();
$emailUtenteLoggato = $_SESSION['email'];
$emailCorrente = mysqli_real_escape_string($cid, $_GET['emailCorrente']);

$query = "SELECT m.*, u.nome AS nome_amico, u.cognome AS cognome_amico
          FROM messaggio AS m
          JOIN utente AS u ON m.email = u.email
          WHERE m.email = '$emailCorrente' 
          ORDER BY m.timestamp DESC";

$result = $cid->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $testo = $row['testo'];
        $email = $row['email'];
        $timestamp = $row['timestamp'];
        $tipo = $row['tipo'];
        $nomeAmico = $row['nome_amico'];
        $cognomeAmico = $row['cognome_amico'];

        $query = "SELECT valutazione FROM valuta
        WHERE emailMessaggio = '$email' AND emailValutazione = '$emailUtenteLoggato' AND timestampMessaggio = '$timestamp'";
        $resultValutazione = $cid->query($query);

        if ($resultValutazione->num_rows > 0) {
            $row = $resultValutazione->fetch_assoc();
            $selezione = $row['valutazione'];
        } else {
            $selezione = "valuta";
        }

        if ($tipo == "testo") {
            echo <<<END
            <div class='post-container'>
                <div class='user-profile'>
                    <img src='../images/unkwownPhoto.jpeg'>
                    <div class='name-post'>
                        <p><a href='frontEnd/bachecaAmico.php?emailCorrente=$email''>$nomeAmico $cognomeAmico</a></p>
                        <small>$timestamp</small>
                    </div>
                </div>
                <p class='post-text'>$testo</p>
                <div class="post-footer">
                    <select class="rating-dropdown">
                        <option disabled selected hidden>$selezione</option>
                        <option value="-3" data-email="$email" data-timestamp="$timestamp">-3
                        </option>
                        <option value="-2" data-email="$email" data-timestamp="$timestamp">-2
                        </option>
                        <option value="-1" data-email="$email" data-timestamp="$timestamp">-1
                        </option>
                        <option value="0" data-email="$email" data-timestamp="$timestamp">0
                        </option>
                        <option value="1" data-email="$email" data-timestamp="$timestamp">1
                        </option>
                        <option value="2" data-email="$email" data-timestamp="$timestamp">2
                        </option>
                        <option value="3" data-email="$email" data-timestamp="$timestamp">3
                        </option>
                    </select>
                    <div>
                        <button>commenta</button>
                    </div>
                </div>
            </div>
            END;
        } else {

        }
    }
} else {
    echo "Nessun post trovato per l'email specificata.";
}
?>