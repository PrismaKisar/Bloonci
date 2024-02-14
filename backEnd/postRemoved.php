<?php
require "dbConnection.php";

try {
    $email = $_POST['emailUtente'];
    $timestamp = $_POST['timestamp'];
    $sql = "DELETE FROM messaggio WHERE messaggio.email = '$email' AND messaggio.timestamp = '$timestamp'";
    $result = $cid->query($sql);
} catch (Exception $error) {
    echo $error;
}

