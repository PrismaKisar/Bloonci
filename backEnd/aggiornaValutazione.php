<?php
require "../backEnd/dbConnection.php";

session_start();
$emailUtenteLoggato = $_SESSION['email'];

// Ottieni i dati inviati tramite POST dal form
$valutazione = $_POST['valutazione'];
$emailMessaggio = $_POST['emailMessaggio'];
$timestampMessaggio = $_POST['timestampMessaggio'];

// Verifica se l'utente ha già valutato il messaggio
$query = "SELECT * FROM valuta WHERE 
    emailValutazione = '$emailUtenteLoggato' AND 
    emailMessaggio = '$emailMessaggio' AND 
    timestampMessaggio = '$timestampMessaggio'";
$result = $cid->query($query);

// Se l'utente ha già valutato il messaggio, aggiorna la valutazione esistente
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $oldID = $row['IDValuta'];
    $query = "DELETE FROM valuta WHERE valuta.IDValuta = $oldID";
    $result = $cid->query($query);
    $query = "INSERT INTO valuta (IDValuta, emailValutazione, emailMessaggio, timestampMessaggio, valutazione) 
        VALUES ('$oldID', '$emailUtenteLoggato', '$emailMessaggio', '$timestampMessaggio', '$valutazione')";
    $result = $cid->query($query);
} else {
    // Se l'utente non ha ancora valutato il messaggio, inserisci una nuova valutazione
    $query = "SELECT MAX(IDValuta) AS maxID FROM valuta";
    $result = $cid->query($query);
    $row = $result->fetch_assoc();
    $newID = $row['maxID'] + 1;
    $query = "INSERT INTO valuta (IDValuta, emailValutazione, emailMessaggio, timestampMessaggio, valutazione) 
        VALUES ('$newID', '$emailUtenteLoggato', '$emailMessaggio', '$timestampMessaggio', '$valutazione')";
    $result = $cid->query($query);
}

// Calcola il valore medio delle valutazioni per il messaggio corrente
$query = "SELECT AVG(valutazione) AS valore_medio
    FROM valuta
    WHERE emailMessaggio = '$emailMessaggio'";
$result = $cid->query($query);

// Se ci sono valutazioni per il messaggio, calcola il valore medio
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $valoreMedio = (int) $row["valore_medio"] - 4;
}

// Calcola la nuova rispettabilità in base al valore medio
$nuovaRispettabilità = calcolaNuovaRispettabilità($valoreMedio);

// Aggiorna il valore di rispettabilità dell'utente nel database
$query = "UPDATE utente SET rispettabilità = '$nuovaRispettabilità' WHERE email = '$emailMessaggio'";

// Esegui la query di aggiornamento
if ($cid->query($query) === TRUE) {
    echo "Il valore di rispettabilità dell'utente con email $emailMessaggio è stato aggiornato con successo.";
} else {
    echo "Errore durante l'aggiornamento del valore di rispettabilità dell'utente: " . $cid->error;
}

// Funzione per calcolare la nuova rispettabilità in base al valore medio
function calcolaNuovaRispettabilità($valoreMedio)
{
    if ($valoreMedio == 3) {
        return 10;
    } elseif ($valoreMedio >= 2.4) {
        return 9;
    } elseif ($valoreMedio >= 1.8) {
        return 8;
    } elseif ($valoreMedio >= 1.2) {
        return 7;
    } elseif ($valoreMedio >= 0.6) {
        return 6;
    } elseif ($valoreMedio >= 0) {
        return 5;
    } elseif ($valoreMedio >= -0.6) {
        return 4;
    } elseif ($valoreMedio >= -1.2) {
        return 3;
    } elseif ($valoreMedio >= -1.8) {
        return 2;
    } elseif ($valoreMedio >= -2.4) {
        return 1;
    } elseif ($valoreMedio >= -3) {
        return 0;
    }
}
