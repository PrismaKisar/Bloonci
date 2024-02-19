<?php
require "dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$emailAmico = $_SESSION['emailBacheca'];

$query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";
$query2 = "SELECT bloccante FROM utente WHERE email = '$emailAmico'";
$result2 = $cid->query($query2);

$result = $cid->query($query);
$row = $result->fetch_assoc();
$row2 = $result2->fetch_assoc();
if ($row['amministratore'] == 1 && is_null($row2['bloccante'])) {
    echo <<<END
        <div class="logout">
            <button class=remove-btn onclick='bloccaUtente("{$emailUtenteLoggato}", "{$emailAmico}")'>Blocca</button>
        </div>
        END;
}
