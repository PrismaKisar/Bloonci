<?php
require "dbConnection.php";

$email = $cid->real_escape_string($_POST["email"]);
$password = $cid->real_escape_string($_POST["password"]);

try {
    $email = $_POST["email"];
    $query = "SELECT email, password, nome, cognome FROM utente WHERE email = '$email'";

    $result = $cid->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($password == $row['password']) {
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];

                header("Location: ../index.php");
                exit();
            } else {
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
?>