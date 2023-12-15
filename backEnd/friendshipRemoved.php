<?php
require "dbConnection.php";
try {
    $emailAmico = $_POST['emailAmico'];
    $emailUtente = $_POST['emailUtente'];

    $sql = "DELETE FROM amicizia 
    WHERE (amicizia.emailRichiedente = '$emailAmico' AND amicizia.emailRicevitore = '$emailUtente') 
    OR (amicizia.emailRichiedente = '$emailUtente' AND amicizia.emailRicevitore = '$emailAmico')";

    $result = $cid->query($sql);

} catch (Exception $error) {
    echo $error;
}
?>