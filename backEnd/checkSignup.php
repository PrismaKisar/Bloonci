<?php
require "dbConnection.php";

// Ottieni la query preparata
$query = getPreparedQuery($cid);

try {
    // Esegui la query
    $query->execute();

    // Se la registrazione va a buon fine
    if ($query->affected_rows > 0) {
        session_start();

        // Salva l'email, il nome e il cognome dell'utente nella sessione
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['nome'] = $_POST['first_name'];
        $_SESSION['cognome'] = $_POST['last_name'];

        // Chiudi la connessione al database
        $cid->close();

        // Esegui la ridirezione a index.php
        header("Location: ../index.php");
        exit();
    } else {
        // Se la registrazione non va a buon fine, gestisci di conseguenza
        echo "Errore durante la registrazione.";
    }
} catch (Exception $error) {
    echo $error;
}

// Funzione per ottenere la query preparata
function getPreparedQuery($cid)
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birth_date = setOrDefault("birth_date");
    $birth_city = setOrDefault("birth_city");
    $province = setOrDefault("province");
    $sex_orient = setOrDefault("sex_orient");

    $query = $cid->prepare("INSERT INTO `utente` (`email`, `password`, `nome`, `cognome`, `dataNascita`, `cittàNacita`, `provinciaNascita`, `orientamentoSessuale`, `rispettabilità`, `bloccante`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, '6', NULL)");

    // Lega i parametri alla query
    $query->bind_param("ssssssss", $email, $password, $first_name, $last_name, $birth_date, $birth_city, $province, $sex_orient);

    return $query;
}

// Funzione per impostare il valore o restituire null
function setOrDefault($value)
{
    if (isset($_POST[$value]) && $_POST[$value] !== '') {
        return $_POST[$value];
    } else {
        return null;
    }
}
?>