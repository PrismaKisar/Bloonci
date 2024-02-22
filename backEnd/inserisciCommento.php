<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}
$emailUtenteLoggato = $_SESSION['email'];
$testoCommento = $_POST['testoCommento'];
$emailMessaggio = $_POST['emailMessaggio'];
$timestampMessaggio = $_POST['timestampMessaggio'];
$IDMessaggio = $_POST['IDMessaggio'];


$query = "SELECT MAX(IDCommento) AS massimo FROM commento";
$result = $cid->query($query);
$row = $result->fetch_assoc();
$IDCommento = $row["massimo"] + 1;

$query = "SELECT COUNT(*) AS total_comments 
FROM commento WHERE emailCommento = '$emailUtenteLoggato' 
AND emailMessaggio = '$emailMessaggio' 
AND timestampMessaggio = '$timestampMessaggio'";
$result = $cid->query($query);
$row = $result->fetch_assoc();
$numeroProgressivo = $row["total_comments"] + 1;

$timestamp = date('Y-m-d H:i:s');
if ($IDMessaggio != '') {
    $query = "INSERT INTO commento (IDCommento, progressivo, emailCommento, emailMessaggio, timestampMessaggio, testo, IDMessaggio) 
        VALUES ('$IDCommento', '$numeroProgressivo', '$emailUtenteLoggato', '$emailMessaggio', '$timestampMessaggio', '$testoCommento', '$IDMessaggio')";
} else {
    $query = "INSERT INTO commento (IDCommento, progressivo, emailCommento, emailMessaggio, timestampMessaggio, testo) 
    VALUES ('$IDCommento', '$numeroProgressivo', '$emailUtenteLoggato', '$emailMessaggio', '$timestampMessaggio', '$testoCommento')";

}

var_dump($query);
$result = $cid->query($query);


$cid->close();