<?php
require "dbConnection.php";

try {
    // Recupera le email dall'array POST
    $emailAmico = $_POST['emailAmico'];
    $emailUtenteLoggato = $_POST['emailUtenteLoggato'];

    // Query per rimuovere il blocco dell'amico
    $sql = "UPDATE utente 
            SET bloccante = NULL
            WHERE email = '$emailAmico'";

    // Esegui la query
    $result = $cid->query($sql);

    // Verifica se l'aggiornamento è stato eseguito con successo
    if ($result === TRUE) {
        echo "Blocco dell'utente rimosso con successo.";
    } else {
        echo "Errore durante la rimozione del blocco dell'utente.";
    }
} catch (Exception $error) {
    // Gestione delle eccezioni
    echo "Si è verificato un errore: " . $error->getMessage();
}
