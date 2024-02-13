<?php
require "dbConnection.php";
session_start();
try {
    $hobby = $_POST['hobby'];
    $emailUtenteLoggato = $_SESSION['email'];

    $sql = "DELETE FROM possiede
    WHERE email = '$emailUtenteLoggato'
    AND hobby = '$hobby';";

    $result = $cid->query($sql);

} catch (Exception $error) {
    echo $error;
}
