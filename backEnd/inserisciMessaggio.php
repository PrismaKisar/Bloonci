<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}

$emailUtenteLoggato = $_SESSION['email'];

$testo = $_POST['testo'];
$tipo = $_POST['tipo'];

$emailUtenteLoggato = $cid->real_escape_string($emailUtenteLoggato);
$testo = $cid->real_escape_string($testo);
$tipo = $cid->real_escape_string($tipo);

$timestamp = date('Y-m-d H:i:s');

$query = "INSERT INTO messaggio (email, timestamp, tipo, testo) VALUES ('$emailUtenteLoggato', '$timestamp', '$tipo', '$testo')";
$result = $cid->query($query);

if ($result) {
    echo "Messaggio inserito con successo.";
} else {
    echo "Errore durante l'inserimento del messaggio: " . $cid->error;
}

$cid->close();