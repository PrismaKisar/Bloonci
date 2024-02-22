<?php
require "dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$emailAmico = $_SESSION['emailBacheca'];

// Query per verificare se l'utente loggato è un amministratore
$query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";
$result = $cid->query($query);

$row = $result->fetch_assoc();

if ($row['amministratore'] == 1) {
    echo <<<END
        <div class="logout">
            <button class=remove-btn onclick='eliminaUtente("{$emailAmico}")'>ELIMINA UTENTE</button>
        </div>
        END;
}