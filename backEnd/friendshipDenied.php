<?php
require "dbConnection.php";
try {
    $emailAmico = $_POST['emailAmico'];
    $emailUtente = $_POST['emailUtente'];

    $sql = "DELETE FROM amicizia 
    WHERE amicizia.emailRichiedente = '$emailAmico' 
    AND amicizia.emailRicevitore = '$emailUtente'";
    $result = $cid->query($sql);
} catch (Exception $error) {
    echo $error;
}

?>