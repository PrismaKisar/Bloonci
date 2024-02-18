<?php
require "dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];

$query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";
if ($result = $cid->query($query)) {
    $row = $result->fetch_assoc();
    if ($row['amministratore'] == 1) {
        echo <<<END
            <div class="logout">
                <button class=remove-btn>Blocca</button>
            </div>
            END;
    }
}