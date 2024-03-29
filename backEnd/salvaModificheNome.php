<?php
require "../backEnd/dbConnection.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuovoNome = $_POST['nome'];
    $nuovoCognome = $_POST['cognome'];

    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "UPDATE utente SET nome = '$nuovoNome', cognome = '$nuovoCognome' WHERE email = '$emailUtenteLoggato'";

    if ($cid->query($sql) === TRUE) {
        echo "Modifiche salvate con successo!";
        $_SESSION['nome'] = $nuovoNome;
        $_SESSION['cognome'] = $nuovoCognome;
    } else {
        echo "Errore durante il salvataggio delle modifiche: " . $cid->error;
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Richiesta non valida";
}