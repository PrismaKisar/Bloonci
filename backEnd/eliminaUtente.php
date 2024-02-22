<?php

require "dbConnection.php";

try {
    // Ottieni l'email dell'amico dalla richiesta POST
    $emailAmico = $_POST['emailAmico'];

    // Query per eliminare l'utente amico dal database
    $sql = "DELETE FROM utente WHERE email = '$emailAmico'";

    // Esegui la query di eliminazione
    $result = $cid->query($sql);

    // Reindirizza l'utente alla homepage dopo l'eliminazione
    header("Location: ../index.php");
} catch (Exception $error) {
    // Gestione delle eccezioni in caso di errore
    echo "Si è verificato un errore: " . $error->getMessage();
}
?>