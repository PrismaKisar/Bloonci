<?php
require "dbConnection.php";

$query = getPreparedQuery($cid);

try {
    $query->execute();

    if ($query->affected_rows > 0) {
        session_start();
        $_SESSION['email'] = $cid->real_escape_string($_POST['email']);
        $_SESSION['nome'] = $cid->real_escape_string($_POST['first_name']);
        $_SESSION['cognome'] = $cid->real_escape_string($_POST['last_name']);

        header("Location: ../index.php");
        exit();
    } else {
        // Se la registrazione non va a buon fine, gestisci di conseguenza
        echo "Errore durante la registrazione.";
    }
} catch (Exception $error) {
    echo $error;
}

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