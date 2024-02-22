<?php

require "../backEnd/dbConnection.php";


session_start();


// Verifica se la richiesta è di tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera il nuovo hobby inviato tramite POST
    $nuovoHobby = $_POST['hobby'];

    // Recupera l'email dell'utente loggato dalla sessione
    $emailUtenteLoggato = $_SESSION['email'];

    // Prepara la query SQL per inserire il nuovo hobby nell tabella "possiede"
    $sql = "INSERT INTO possiede (hobby, email) VALUES ('$nuovoHobby', '$emailUtenteLoggato');";

    // Esegui la query SQL e gestisci il risultato
    if ($cid->query($sql) === TRUE) {
        // Se l'inserimento ha avuto successo, restituisci un messaggio di conferma
        echo "Modifiche salvate con successo!";
    } else {
        // Se si è verificato un errore durante l'inserimento, restituisci un messaggio di errore
        echo "Errore durante il salvataggio delle modifiche: " . $cid->error;
    }
} else {
    // Se la richiesta non è di tipo POST, restituisci un errore "Richiesta non valida"
    echo "Richiesta non valida";
}
