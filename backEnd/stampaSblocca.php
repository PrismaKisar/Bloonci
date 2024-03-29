<?php
require "dbConnection.php";

$emailUtenteLoggato = $_SESSION['email'];
$emailAmico = $_SESSION['emailBacheca'];

// Query per verificare se l'utente loggato è un amministratore
$query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";

// Query per ottenere l'informazione sul blocco dell'amico
$query2 = "SELECT bloccante FROM utente WHERE email = '$emailAmico'";
$result2 = $cid->query($query2);

// Esegui la query per verificare se l'utente loggato è un amministratore
if ($result = $cid->query($query)) {
    $row = $result->fetch_assoc();
    $row2 = $result2->fetch_assoc();

    // Se l'utente è un amministratore e l'amico è bloccato, visualizza il pulsante di sblocco
    if ($row['amministratore'] == 1 && !is_null($row2['bloccante'])) {
        echo <<<END
            <div class="logout">
                <button class=remove-btn onclick='sbloccaUtente("{$emailUtenteLoggato}", "{$emailAmico}")'>Sblocca</button>
            </div>
            END;
    }
}
