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
