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
} else {
    echo json_encode("non tanto bene");
}