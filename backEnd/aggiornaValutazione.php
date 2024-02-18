<?php
require "../backEnd/dbConnection.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailUtenteLoggato = $_SESSION['email'];
    $valutazione = $_POST['valutazione'];
    $emailMessaggio = $_POST['emailMessaggio'];
    $timestampMessaggio = $_POST['timestampMessaggio'];

    $query = "SELECT * FROM valuta WHERE 
    emailValutazione = '$emailUtenteLoggato' AND 
    emailMessaggio = '$emailMessaggio' AND 
    timestampMessaggio = ' $timestampMessaggio' ";

    $result = $cid->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $oldID = $row['IDValuta'];
        $query = "DELETE FROM valuta WHERE valuta.IDValuta = $oldID";
        $result = $cid->query($query);
        $query = "INSERT INTO valuta (IDValuta, emailValutazione, emailMessaggio, timestampMessaggio, valutazione) 
        VALUES ('$oldID', '$emailUtenteLoggato', '$emailMessaggio', ' $timestampMessaggio', '$valutazione')";
        $result = $cid->query($query);
    } else {
        $query = "SELECT MAX(IDValuta) AS maxID FROM valuta";
        $result = $cid->query($query);
        $row = $result->fetch_assoc();
        $newID = $row['maxID'] + 1;
        $query = "INSERT INTO valuta (IDValuta, emailValutazione, emailMessaggio, timestampMessaggio, valutazione) 
        VALUES ('$newID', '$emailUtenteLoggato', '$emailMessaggio', ' $timestampMessaggio', '$valutazione')";
        $result = $cid->query($query);
    }
    $query = "SELECT AVG(valutazione) AS valore_medio
    FROM valuta
    WHERE emailMessaggio = '$emailMessaggio'";
    $result = $cid->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $valoreMedio = (int) $row["valore_medio"] - 4;
    }
    var_dump($valoreMedio);

    if ($valoreMedio == 3) {
        $nuovaRispettabilità = 10;
    } elseif ($valoreMedio >= 2.4) {
        $nuovaRispettabilità = 9;
    } elseif ($valoreMedio >= 1.8) {
        $nuovaRispettabilità = 8;
    } elseif ($valoreMedio >= 1.2) {
        $nuovaRispettabilità = 7;
    } elseif ($valoreMedio >= 0.6) {
        $nuovaRispettabilità = 6;
    } elseif ($valoreMedio >= 0) {
        $nuovaRispettabilità = 5;
    } elseif ($valoreMedio >= -0.6) {
        $nuovaRispettabilità = 4;
    } elseif ($valoreMedio >= -1.2) {
        $nuovaRispettabilità = 3;
    } elseif ($valoreMedio >= -1.8) {
        $nuovaRispettabilità = 2;
    } elseif ($valoreMedio >= -2.4) {
        $nuovaRispettabilità = 1;
    } elseif ($valoreMedio >= -3) {
        $nuovaRispettabilità = 0;
    }

    $query = "UPDATE utente SET rispettabilità = '$nuovaRispettabilità' WHERE email = '$emailMessaggio'";
    var_dump($query);
    if ($cid->query($query) === TRUE) {
        echo "Il valore di rispettabilità dell'utente con email $emailMessaggio è stato aggiornato con successo.";
    } else {
        echo "Errore durante l'aggiornamento del valore di rispettabilità dell'utente: " . $cid->error;
    }
} else {
    echo json_encode("non tanto bene");
}