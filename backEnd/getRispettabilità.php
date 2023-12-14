<?php
require "dbConnection.php";

try {
    $emailUtenteLoggato = $_SESSION['email'];
    $query = "SELECT rispettabilità FROM utente WHERE email = '$emailUtenteLoggato'";
    $result = $cid->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['rispettabilità'];
        } else {
            echo "non disponibile";
        }
    } else {
        echo "Errore nella query: " . $cid->error;
    }
} catch (Exception $error) {
    echo $error;
}
?>