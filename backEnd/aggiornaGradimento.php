<?php
require "../backEnd/dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$gradimento = $_POST['gradimento'];
$emailGradimento = $_POST['emailGradimento'];
$IDCommento = $_POST['IDCommento'];


$query = "SELECT * FROM gradimento WHERE 
    IDCommento = '$IDCommento' AND 
    emailGradimento = '$emailUtenteLoggato'";
$result = $cid->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $IDgradimento = $row['IDGradimento'];
    $query = "DELETE FROM gradimento WHERE IDCommento = $IDgradimento";
    $result = $cid->query($query);
    $query = "INSERT INTO gradimento (IDGradimento, IDCommento, indiceGradimento, emailGradimento) 
        VALUES ('$IDgradimento', '$IDCommento', '$gradimento', '$emailUtenteLoggato')";
    $result = $cid->query($query);
} else {
    $query = "SELECT MAX(IDGradimento) AS maxID FROM gradimento";
    $result = $cid->query($query);
    $row = $result->fetch_assoc();
    $IDgradimento = $row['maxID'] + 1;
    $query = "INSERT INTO gradimento (IDGradimento, IDCommento, indiceGradimento, emailGradimento) 
        VALUES ('$IDgradimento', '$IDCommento', '$gradimento', '$emailUtenteLoggato')";
    $result = $cid->query($query);
}


