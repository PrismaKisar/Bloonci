<?php
require "dbConnection.php";
try {
    $emailAmico = $_POST['emailAmico'];
    $emailUtente = $_POST['emailUtente'];
    $currentDate = date("Y-m-d");

    $sql = "UPDATE amicizia 
        SET dataAccettazione = '$currentDate'
        WHERE amicizia.emailRichiedente = '$emailAmico' 
        AND amicizia.emailRicevitore = '$emailUtente'";
    $result = $cid->query($sql);
} catch (Exception $error) {
    echo $error;
}

?>