<?php
require "dbConnection.php";

try {
    // Recupera l'email dell'amico e dell'utente dalla richiesta POST
    $emailAmico = $_POST['emailAmico'];
    $emailUtente = $_POST['emailUtente'];

    // Ottieni la data corrente nel formato "YYYY-MM-DD"
    $currentDate = date("Y-m-d");

    // Query per aggiornare la data di accettazione dell'amicizia tra l'amico e l'utente
    $sql = "UPDATE amicizia 
            SET dataAccettazione = '$currentDate'
            WHERE amicizia.emailRichiedente = '$emailAmico' 
            AND amicizia.emailRicevitore = '$emailUtente'";

    // Esegui la query
    $result = $cid->query($sql);
} catch (Exception $error) {
    // Gestione delle eccezioni in caso di errore
    echo $error;
}
?>