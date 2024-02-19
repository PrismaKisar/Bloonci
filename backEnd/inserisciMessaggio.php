<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}

$emailUtenteLoggato = $_SESSION['email'];
$targetDirectory = "../images/";
$targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Controlla se il file è un'immagine reale o un falso
$check = getimagesize($_FILES["file"]["tmp_name"]);
if ($check === false) {
    echo "Il file non è un'immagine.";
    $uploadOk = 0;
    exit();
}

// Controlla se il file esiste già
if (file_exists($targetFile)) {
    echo "Il file esiste già.";
    $uploadOk = 0;
    exit();
}

// Consentire solo alcuni formati di file
$allowedFormats = array("jpg", "png", "jpeg", "gif");
if (!in_array($imageFileType, $allowedFormats)) {
    echo "Sono consentiti solo file JPG, JPEG, PNG e GIF.";
    $uploadOk = 0;
    exit();
}

if ($uploadOk == 0) {
    echo "Il file non è stato caricato.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "Il file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " è stato caricato.";
    } else {
        echo "Si è verificato un errore durante il caricamento del file.";
        exit();
    }
}

$testo = $_POST['testo'];
$tipo = $_POST['tipo'];

$emailUtenteLoggato = $cid->real_escape_string($emailUtenteLoggato);
$testo = $cid->real_escape_string($testo);
$tipo = $cid->real_escape_string($tipo);

$timestamp = date('Y-m-d H:i:s');

$query = "INSERT INTO messaggio (email, timestamp, tipo, testo) VALUES ('$emailUtenteLoggato', '$timestamp', '$tipo', '$testo')";
$result = $cid->query($query);

if ($result) {
    echo "Messaggio inserito con successo.";
} else {
    echo "Errore durante l'inserimento del messaggio: " . $cid->error;
}

$cid->close();