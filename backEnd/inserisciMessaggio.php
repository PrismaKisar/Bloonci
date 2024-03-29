<?php
session_start();
require "dbConnection.php";

if (!isset($_SESSION['email'])) {
    echo "Errore: Utente non autenticato";
    exit();
}
$emailUtenteLoggato = $_SESSION['email'];

if (!is_null($_FILES["file"]["name"])) {
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
    $imageFileType = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $nuovoNome = uniqid() . "." . $imageFileType;
    $targetFile = $targetDirectory . $nuovoNome;
    $uploadOk = 1;

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
}

$testo = $_POST['testo'];
$tipo = $_POST['tipo'];
$provincia = $_POST['provincia'];
$città = $_POST['città'];


$emailUtenteLoggato = $cid->real_escape_string($emailUtenteLoggato);
$testo = $cid->real_escape_string($testo);
$tipo = $cid->real_escape_string($tipo);

// Timestamp
$timestamp = date('Y-m-d H:i:s');


$sql = "SELECT MAX(IDMessaggio) AS MaxIDMessaggio FROM messaggio";
$result = $cid->query($sql);

$row = $result->fetch_assoc();
$IDMessaggio = $row["MaxIDMessaggio"] + 1;



if ($tipo == "testo") {
    if ($città == "" && $provincia == "") {
        $query = "INSERT INTO messaggio (IDMessaggio, email, timestamp, tipo, testo, provincia, città) VALUES ('$IDMessaggio', '$emailUtenteLoggato', '$timestamp', '$tipo', '$testo', NULL, NULL)";
        $result = $cid->query($query);
    } else {
        $query = "INSERT INTO messaggio (IDMessaggio, email, timestamp, tipo, testo, provincia, città) VALUES ('$IDMessaggio', '$emailUtenteLoggato', '$timestamp', '$tipo', '$testo', '$provincia', '$città')";
        $result = $cid->query($query);
    }
} else {
    $targetDirectory = substr($targetDirectory, 3);
    if ($città == "" && $provincia == "") {
        $query = "INSERT INTO messaggio (IDMessaggio, email, timestamp, tipo, testo, nome, percorso, provincia, città) VALUES ('$IDMessaggio', '$emailUtenteLoggato', '$timestamp', '$tipo', '$testo', '$nuovoNome', '$targetDirectory', NULL, NULL)";
        var_dump($query);
        $result = $cid->query($query);
    } else {
        $query = "INSERT INTO messaggio (IDMessaggio, email, timestamp, tipo, testo, nome, percorso, provincia, città) VALUES ('$IDMessaggio', '$emailUtenteLoggato', '$timestamp', '$tipo', '$testo', '$nuovoNome', '$targetDirectory', '$provincia', '$città')";
        var_dump($query);
        $result = $cid->query($query);
    }
}


if ($result) {
    echo "Messaggio inserito con successo.";
} else {
    echo "Errore durante l'inserimento del messaggio: " . $cid->error;
}

$cid->close();