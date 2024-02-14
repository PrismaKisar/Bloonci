<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}


// Ottieni l'email dell'utente loggato
$email = $_SESSION['email'];



// Ottieni il testo del messaggio dalla richiesta POST
if (isset($_POST['testo'])) {
    $testo = $_POST['testo'];
} else {
    echo "Errore: Il testo del messaggio non è stato fornito";
    exit();
}

// Ottieni il timestamp attuale
$timestamp = date('Y-m-d H:i:s');



// Prepara e esegui la query per inserire il nuovo messaggio nel database
$query = "INSERT INTO messaggio (email, timestamp, tipo, testo) VALUES (?, ?, 'testo', ?)";

$stmt = $cid->prepare($query);

$stmt->bind_param("sss", $email, $timestamp, $testo);

$stmt->execute();
$stmt->close();


// Chiudi la connessione al database
$cid->close();

// Restituisci una risposta di successo
echo "Messaggio pubblicato con successo!";
