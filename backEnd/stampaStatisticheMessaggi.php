<?php
require "../backEnd/dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$emailUtente = $_GET['emailCorrente'];

$query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";
$result = $cid->query($query);
$isAmministratore = $row['amministratore'];

// Data attuale
$currentDate = date("Y-m-d");

// Data di una settimana fa
$oneWeekAgo = date("Y-m-d", strtotime("-1 week"));

// Query per recuperare i messaggi pubblicati dall'utente nell'ultima settimana
$sql = "SELECT DATE(timestamp) AS data, COUNT(*) AS num_messaggi
        FROM messaggio
        WHERE email = '$emailUtente'
        AND timestamp BETWEEN '$oneWeekAgo 00:00:00' AND '$currentDate 23:59:59'
        GROUP BY DATE(timestamp)";

$result = $cid->query($sql);

if ($result->num_rows > 0) {
    // Popolamento dell'array con i messaggi pubblicati dall'utente
    while ($row = $result->fetch_assoc()) {
        $data = date("N", strtotime($row["data"])) - 1; // Ottieni il numero del giorno della settimana (da 0 a 6)
        $messagesPerDay[$data] = $row["num_messaggi"];
    }
}

// Aggiungi zeri per i giorni senza messaggi
for ($i = 0; $i < 7; $i++) {
    if ($messagesPerDay[$i] == 0) {
        $messagesPerDay[$i] = 0;
    }
}

// Calcolo del numero massimo, minimo e medio di messaggi al giorno
$maxMessages = max($messagesPerDay);
$minMessages = min($messagesPerDay);
$totalMessages = array_sum($messagesPerDay);
$averageMessages = number_format($totalMessages / 7, 2);

if ($isAmministratore == 1) {
    echo <<<END
        <div class="sidebar-title">
            <h4 style="margin-bottom: 0px;">Statistiche</h4>
        </div>
        Numero max messaggi: $maxMessages <br>
        Numero min messaggi: $minMessages <br>
        Media messaggi: $averageMessages <br>
        <hr class="separator">
        END;
}


