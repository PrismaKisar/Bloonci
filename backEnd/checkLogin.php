<?php

require "dbConnection.php";

// Ottieni l'email e la password inviate tramite POST
$email = $cid->real_escape_string($_POST["email"]);
$password = $cid->real_escape_string($_POST["password"]);

try {
    // Query per selezionare l'utente corrispondente all'email fornita
    $query = "SELECT email, password, nome, cognome FROM utente WHERE email = '$email'";
    $result = $cid->query($query);

    if ($result) { // Verifica se la query è stata eseguita con successo
        if ($result->num_rows > 0) { // Verifica se esiste un utente con quell'email
            $row = $result->fetch_assoc(); // Ottieni i dati dell'utente

            if ($password == $row['password']) { // Verifica se la password fornita corrisponde a quella dell'utente
                // Avvia la sessione e memorizza i dati dell'utente
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];

                // Reindirizza l'utente alla pagina principale dopo il login
                header("Location: ../index.php");
                exit();
            } else {
                // Reindirizza l'utente alla pagina di login con un messaggio di errore
                header("Location: ../frontEnd/login.html?error=loginerror");
                exit();
            }
        } else {
            // Reindirizza l'utente alla pagina di login con un messaggio di errore
            header("Location: ../frontEnd/login.html?error=loginerror");
            exit();
        }
    } else {
        // Se si verifica un errore nella query, interrompi l'esecuzione e mostra un messaggio di errore
        die("Errore nella query: " . $cid->error);
    }
} catch (Exception $error) {
    // Gestione delle eccezioni
    echo $error; // Mostra eventuali errori
}