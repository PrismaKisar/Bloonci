<?php

require "dbConnection.php";

try {
    // Recupera le email dall'array POST
    $emailAmico = $_POST['emailAmico']; // Email dell'amico da bloccare
    $emailUtenteLoggato = $_POST['emailUtenteLoggato']; // Email dell'utente loggato che esegue l'operazione

    // Query per aggiornare il campo 'bloccante' dell'amico
    $sql = "UPDATE utente 
            SET bloccante = '$emailUtenteLoggato'
            WHERE email = '$emailAmico'";

    // Esegui la query
    $result = $cid->query($sql);

    // Verifica se l'aggiornamento è stato eseguito con successo
    if ($result === TRUE) {
        echo "Utente bloccato con successo."; // Messaggio di successo
    } else {
        echo "Errore durante il blocco dell'utente."; // Messaggio di errore
    }
} catch (Exception $error) {
    // Gestione delle eccezioni
    echo "Si è verificato un errore: " . $error->getMessage(); // Messaggio di errore
}
