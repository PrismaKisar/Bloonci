<?php
require "dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$emailAmico = $_SESSION['emailBacheca'];

$query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";
if ($result = $cid->query($query)) {
    $row = $result->fetch_assoc();
    if ($row['amministratore'] == 1) {
        echo <<<END
            <div class="logout">
                <button class=remove-btn onclick='bloccaUtente("{$emailUtenteLoggato}", "{$emailAmico}")'>Blocca</button>
            </div>
            END;
    }
}