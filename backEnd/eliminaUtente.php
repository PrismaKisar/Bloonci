<?php
require "dbConnection.php";

try {
    $emailAmico = $_POST['emailAmico'];

    $sql = "DELETE FROM utente WHERE email = '$emailAmico'";
    $result = $cid->query($sql);

    header("Location: ../index.php");
} catch (Exception $error) {
    echo "Si è verificato un errore: " . $error->getMessage();
}