<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}
var_dump($IDMessaggio);

try {
    $IDMessaggio = $_POST['IDMessaggio'];

    header("Location: ../frontEnd/messaggioRiferito.php?IDMessaggio=$IDMessaggio");
} catch (Exception $error) {
    echo $error;
}
