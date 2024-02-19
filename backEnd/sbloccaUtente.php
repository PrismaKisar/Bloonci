<?php
require "dbConnection.php";
try {
    $emailAmico = $_POST['emailAmico'];
    $emailUtenteLoggato = $_POST['emailUtenteLoggato'];
    $sql = "UPDATE utente 
        SET bloccante = NULL
        WHERE email = '$emailAmico'";
    var_dump($sql);
    $result = $cid->query($sql);
} catch (Exception $error) {
    echo $error;
}
