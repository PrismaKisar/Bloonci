<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "dbConnection.php";

$email = $_POST["email"];
$password = $_POST["password"];

try {
    $query = getPreparedQuery($cid);
    $result = $cid->query($query);

    if ($result) {
        // Controlla se ci sono righe restituite
        if ($result->num_rows > 0) {
            // Estrai la riga risultato
            $row = $result->fetch_assoc();

            // Verifica la corrispondenza della password con quella fornita
            if ($password == $row['password']) {
                session_start();

                // Salva l'email, il nome e il cognome dell'utente nella sessione
                $_SESSION['email'] = $row['email'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];
                $_SESSION['rispettabilità'] = $row['rispettabilità'];

                // Esegui la ridirezione a index.html
                header("Location: ../index.php");
                exit();
            } else {
                // Esegui la ridirezione a login.html
                header("Location: ../frontEnd/login.html");
                exit();
            }
        } else {
            header("Location: ../frontEnd/login.html");
            exit();
        }

    } else {
        die("Errore nella query: " . $cid->error);
    }
} catch (Exception $error) {
    echo $error;
}

// Chiudi la connessione al database
$cid->close();

function getPreparedQuery($cid)
{
    $email = $_POST["email"];
    $query = "SELECT email, password, nome, cognome, rispettabilità FROM utente WHERE email = '$email'";
    return $query;
}
?>