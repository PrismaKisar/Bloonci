<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}


$emailUtenteLoggato = $_SESSION['email'];

if (isset($_POST['testo'])) {
    $testo = $_POST['testo'];
} else {
    echo "Errore: Il testo del messaggio non è stato fornito";
    exit();
}

$timestamp = date('Y-m-d H:i:s');
$query = "INSERT INTO messaggio (email, timestamp, tipo, testo) VALUES (?, ?, 'testo', ?)";
$stmt = $cid->prepare($query);
$stmt->bind_param("sss", $emailUtenteLoggato, $timestamp, $testo);
$stmt->execute();
$stmt->close();


// Chiudi la connessione al database
$cid->close();