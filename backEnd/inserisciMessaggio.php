<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}

$emailUtenteLoggato = $_SESSION['email'];

// Directory di destinazione per l'utente loggato
$targetDirectory = "../images/$emailUtenteLoggato/";

// Crea la directory se non esiste
if (!is_dir($targetDirectory)) {
    if (!mkdir($targetDirectory, 0755, true)) { // Imposta i permessi della nuova directory
        echo "Errore: Impossibile creare la directory.";
        exit();
    }
}

$nome = basename($_FILES["file"]["name"]);
$targetFile = $targetDirectory . $nome;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Controlli sull'immagine
if (!getimagesize($_FILES["file"]["tmp_name"])) {
    echo "Il file non è un'immagine.";
    $uploadOk = 0;
    exit();
}

if (file_exists($targetFile)) {
    echo "Il file esiste già.";
    $uploadOk = 0;
    exit();
}

$allowedFormats = array("jpg", "png", "jpeg", "gif");
if (!in_array($imageFileType, $allowedFormats)) {
    echo "Sono consentiti solo file JPG, JPEG, PNG e GIF.";
    $uploadOk = 0;
    exit();
}

if ($uploadOk == 0) {
    echo "Il file non è stato caricato.";
    exit();
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "Il file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " è stato caricato.";
    } else {
        echo "Si è verificato un errore durante il caricamento del file.";
        exit();
    }
}

// Gestione del testo e del tipo
$testo = $_POST['testo'];
$tipo = $_POST['tipo'];

// Escape dei dati
$emailUtenteLoggato = $cid->real_escape_string($emailUtenteLoggato);
$testo = $cid->real_escape_string($testo);
$tipo = $cid->real_escape_string($tipo);

// Timestamp
$timestamp = date('Y-m-d H:i:s');

if ($tipo == "testo") {
    $query = "INSERT INTO messaggio (email, timestamp, tipo, testo) VALUES ('$emailUtenteLoggato', '$timestamp', '$tipo', '$testo')";
    $result = $cid->query($query);
} else {
    $targetDirectory = substr($targetDirectory, 3);
    $query = "INSERT INTO messaggio (email, timestamp, tipo, testo, nome, percorso) VALUES ('$emailUtenteLoggato', '$timestamp', '$tipo', '$testo', '$nome', '$targetDirectory')";
    var_dump($query);
    $result = $cid->query($query);
}


if ($result) {
    echo "Messaggio inserito con successo.";
} else {
    echo "Errore durante l'inserimento del messaggio: " . $cid->error;
}

$cid->close();