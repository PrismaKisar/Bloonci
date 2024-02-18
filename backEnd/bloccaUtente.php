<?php
require "dbConnection.php";
try {
    $emailAmico = $_POST['emailAmico'];
    $emailUtenteLoggato = $_POST['emailUtenteLoggato'];
    $sql = "UPDATE utente 
        SET bloccante = '$emailUtenteLoggato'
        WHERE email = '$emailAmico'";
    $result = $cid->query($sql);
} catch (Exception $error) {
    echo $error;
}
