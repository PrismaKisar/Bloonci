<?php
// sendRequest.php

require "dbConnection.php";
session_start();

try {
    if (isset($_SESSION['email']) && isset($_POST['emailRicevente'])) {
        $emailRichiedente = $_SESSION['email'];
        $emailRicevente = $_POST['emailRicevente'];
        $dataRichiesta = date("Y-m-d");

        // Esegui l'inserimento nella tabella amicizia
        $sql = "INSERT INTO amicizia (emailRichiedente, emailRicevitore, dataRichiesta) VALUES ('$emailRichiedente', '$emailRicevente', '$dataRichiesta')";
        $result = $cid->query($sql);

    }
} catch (Exception $error) {
    echo $error;
}

?>