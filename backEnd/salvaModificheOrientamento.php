<?php
require "../backEnd/dbConnection.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuovoOrientamento = $_POST['orientamento'];

    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "UPDATE utente SET orientamentoSessuale = '$nuovoOrientamento' WHERE email = '$emailUtenteLoggato'";

    if ($cid->query($sql) === TRUE) {
        echo "Modifiche salvate con successo!";
    } else {
        echo "Errore durante il salvataggio delle modifiche: " . $cid->error;
    }
} else {
    // Se i dati non sono stati inviati tramite metodo POST, restituisci un errore
    header("HTTP/1.1 400 Bad Request");
    echo "Richiesta non valida";
}