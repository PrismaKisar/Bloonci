<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}

try {
    $IDMessaggio = $_POST['IDMessaggio'];

    header("Location: ../frontEnd/login.html");
} catch (Exception $error) {
    echo $error;
}
