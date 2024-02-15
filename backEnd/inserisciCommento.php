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

$query = "SELECT COUNT(*) AS total_comments FROM commento";
$result = $cid->query($query);
$row = $result->fetch_assoc();
$IDCommento = $row["total_comments"] + 1;

$query = "SELECT COUNT(*) AS total_comments 
FROM commento WHERE emailCommento = '$emailUtenteLoggato' 
AND emailMessaggio = '$emailMessaggio' 
AND timestampMessaggio = '$timestampMessaggio'";
$result = $cid->query($query);
$row = $result->fetch_assoc();
$numeroProgressivo = $row["total_comments"] + 1;

$timestamp = date('Y-m-d H:i:s');
$query = "INSERT INTO commento (IDCommento, progressivo, emailCommento, emailMessaggio, timestampMessaggio, testo, indiceGradimento) 
VALUES ('$IDCommento', '$numeroProgressivo', '$emailUtenteLoggato', '$emailMessaggio', '$timestampMessaggio', '$testoCommento', NULL)";
$result = $cid->query($query);


$cid->close();