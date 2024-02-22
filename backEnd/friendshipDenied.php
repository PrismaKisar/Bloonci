<?php
require "dbConnection.php";

try {
    // Recupera l'email dell'amico e dell'utente dalla richiesta POST
    $emailAmico = $_POST['emailAmico'];
    $emailUtente = $_POST['emailUtente'];

    // Query per eliminare l'amicizia tra l'amico e l'utente
    $sql = "DELETE FROM amicizia 
            WHERE amicizia.emailRichiedente = '$emailAmico' 
            AND amicizia.emailRicevitore = '$emailUtente'";

    // Esegui la query
    $result = $cid->query($sql);
} catch (Exception $error) {
    // Gestione delle eccezioni in caso di errore
    echo $error;
}
?>