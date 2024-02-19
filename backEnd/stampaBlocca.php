<?php
require "dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$emailAmico = $_SESSION['emailBacheca'];

// Query per verificare se l'utente loggato è un amministratore
$query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";

// Query per ottenere l'informazione sul blocco dell'amico
$query2 = "SELECT bloccante FROM utente WHERE email = '$emailAmico'";

// Esegui le query per verificare se l'utente loggato è un amministratore e ottenere l'informazione sul blocco dell'amico
$result = $cid->query($query);
$result2 = $cid->query($query2);

// Estrai i risultati delle query
$row = $result->fetch_assoc();
$row2 = $result2->fetch_assoc();

// Se l'utente è un amministratore e l'amico non è bloccato, visualizza il pulsante di blocco
if ($row['amministratore'] == 1 && is_null($row2['bloccante'])) {
    echo <<<END
        <div class="logout">
            <button class=remove-btn onclick='bloccaUtente("{$emailUtenteLoggato}", "{$emailAmico}")'>Blocca</button>
        </div>
        END;
}
