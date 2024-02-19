<?php
require "dbConnection.php";

try {
    // Recupera le email dall'array POST
    $emailAmico = $_POST['emailAmico'];
    $emailUtenteLoggato = $_POST['emailUtenteLoggato'];

    // Query per aggiornare il campo 'bloccante' dell'amico
    $sql = "UPDATE utente 
            SET bloccante = '$emailUtenteLoggato'
            WHERE email = '$emailAmico'";

    // Esegui la query
    $result = $cid->query($sql);

    // Verifica se l'aggiornamento è stato eseguito con successo
    if ($result === TRUE) {
        echo "Utente bloccato con successo.";
    } else {
        echo "Errore durante il blocco dell'utente.";
    }
} catch (Exception $error) {
    // Gestione delle eccezioni
    echo "Si è verificato un errore: " . $error->getMessage();
}
