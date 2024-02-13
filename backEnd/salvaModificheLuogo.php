<?php
require "../backEnd/dbConnection.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuovaProvincia = $_POST['provincia'];
    $nuovaCittà = $_POST['città'];


    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "UPDATE utente SET provinciaNascita = '$nuovaProvincia', cittàNascita = '$nuovaCittà' WHERE email = '$emailUtenteLoggato'";

    if ($cid->query($sql) === TRUE) {
        echo "Modifiche salvate con successo!";
    } else {
        echo "Errore durante il salvataggio delle modifiche: " . $cid->error;
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Richiesta non valida";
}