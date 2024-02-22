<?php
require "../backEnd/dbConnection.php";

// Funzione per ottenere le statistiche dei messaggi dell'utente nell'ultima settimana
function getMessagesStatistics($cid, $emailUtente)
{
    // Ottieni la data attuale e la data di una settimana fa
    $currentDate = date("Y-m-d");
    $oneWeekAgo = date("Y-m-d", strtotime("-1 week"));

    // Ottieni il numero di messaggi per giorno della settimana
    $messagesPerDay = getMessagesPerDay($cid, $emailUtente, $oneWeekAgo, $currentDate);

    // Calcola il numero totale di messaggi e la media giornaliera
    $totalMessages = array_sum($messagesPerDay);
    $averageMessages = number_format($totalMessages / 7, 2);

    // Restituisci le statistiche
    return array("maxMessages" => max($messagesPerDay), "minMessages" => min($messagesPerDay), "averageMessages" => $averageMessages);
}

// Funzione per ottenere il numero di messaggi per ogni giorno della settimana
function getMessagesPerDay($cid, $emailUtente, $startDate, $endDate)
{
    // Inizializza un array per memorizzare i messaggi per ogni giorno della settimana
    $messagesPerDay = array_fill(0, 7, 0);

    // Query per recuperare i messaggi pubblicati dall'utente nell'ultima settimana
    $sql = "SELECT DATE(timestamp) AS data, COUNT(*) AS num_messaggi
            FROM messaggio
            WHERE email = '$emailUtente'
            AND timestamp BETWEEN '$startDate 00:00:00' AND '$endDate 23:59:59'
            GROUP BY DATE(timestamp)";

    // Esegui la query sul database
    $result = $cid->query($sql);

    // Popola l'array con il numero di messaggi per ogni giorno della settimana
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Ottieni il giorno della settimana (da 0 a 6) e aggiorna l'array
            $dayOfWeek = date("N", strtotime($row["data"])) - 1;
            $messagesPerDay[$dayOfWeek] = $row["num_messaggi"];
        }
    }

    // Restituisci l'array con il numero di messaggi per ogni giorno della settimana
    return $messagesPerDay;
}

// Controllo dell'autenticazione e visualizzazione delle statistiche se l'utente è amministratore
if (isset($_SESSION['email']) && isset($_GET['emailCorrente'])) {
    // Ottieni l'email dell'utente loggato e verifica se è amministratore
    $emailUtenteLoggato = $_SESSION['email'];
    $query = "SELECT amministratore FROM utente WHERE email = '$emailUtenteLoggato'";
    $result = $cid->query($query);

    // Se l'utente è amministratore, visualizza le statistiche
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $isAmministratore = $row['amministratore'];

        if ($isAmministratore == 1) {
            // Ottieni l'email dell'utente di cui visualizzare le statistiche
            $emailUtente = $_GET['emailCorrente'];

            // Ottieni le statistiche dei messaggi per l'utente specificato
            $stats = getMessagesStatistics($cid, $emailUtente);

            // Output delle statistiche
            echo <<<END
                <div class="sidebar-title">
                    <h4 style="margin-bottom: 0px;">Statistiche</h4>
                </div>
                Numero max messaggi: {$stats['maxMessages']} <br>
                Numero min messaggi: {$stats['minMessages']} <br>
                Media messaggi: {$stats['averageMessages']} <br>
                <hr class="separator">
            END;
        }
    }
}