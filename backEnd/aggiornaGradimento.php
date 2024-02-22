<?php

require "../backEnd/dbConnection.php";

session_start();

// Recupera l'email dell'utente loggato dalla sessione
$emailUtenteLoggato = $_SESSION['email'];

$gradimento = $_POST['gradimento'];
$emailGradimento = $_POST['emailGradimento'];
$IDCommento = $_POST['IDCommento'];

// Query per verificare se l'utente ha già valutato il commento
$query = "SELECT * FROM gradimento WHERE 
    IDCommento = '$IDCommento' AND 
    emailGradimento = '$emailUtenteLoggato'";
$result = $cid->query($query);

// Se l'utente ha già valutato il commento, aggiorna la valutazione esistente
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $IDgradimento = $row['IDGradimento'];
    $query = "DELETE FROM gradimento WHERE gradimento.IDGradimento = '$IDgradimento'";
    $result = $cid->query($query);
    $query = "INSERT INTO gradimento (IDGradimento, IDCommento, indiceGradimento, emailGradimento) 
        VALUES ('$IDgradimento', '$IDCommento', '$gradimento', '$emailUtenteLoggato')";
    $result = $cid->query($query);
} else {
    // Se l'utente non ha ancora valutato il commento, inserisce una nuova valutazione
    $query = "SELECT MAX(IDGradimento) AS maxID FROM gradimento";
    $result = $cid->query($query);
    $row = $result->fetch_assoc();
    $IDgradimento = $row['maxID'] + 1;
    $query = "INSERT INTO gradimento (IDGradimento, IDCommento, indiceGradimento, emailGradimento) 
        VALUES ('$IDgradimento', '$IDCommento', '$gradimento', '$emailUtenteLoggato')";
    $result = $cid->query($query);
}

// Calcola il valore medio delle valutazioni per il messaggio corrente
$query = "SELECT AVG(g.indiceGradimento) AS media_totale_gradimenti
FROM gradimento g
JOIN commento c ON g.IDCommento = c.IDCommento
WHERE c.emailCommento = '$emailUtenteLoggato';";
$result = $cid->query($query);

// Se ci sono valutazioni per il messaggio, calcola il valore medio
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $valoreMedio = (int) $row["media_totale_gradimenti"] - 4;
}

// Calcola la nuova rispettabilità in base al valore medio
$nuovaRispettabilità = calcolaNuovaRispettabilità($valoreMedio);

// Aggiorna il valore di rispettabilità dell'utente nel database
$query = "UPDATE utente SET rispettabilità = '$nuovaRispettabilità' WHERE email = '$emailUtenteLoggato'";

// Esegui la query di aggiornamento
if ($cid->query($query) === TRUE) {
    echo "Il valore di rispettabilità dell'utente con email $emailUtenteLoggato è stato aggiornato con successo.";
} else {
    echo "Errore durante l'aggiornamento del valore di rispettabilità dell'utente: " . $cid->error;
}

// Funzione per calcolare la nuova rispettabilità in base al valore medio
function calcolaNuovaRispettabilità($valoreMedio)
{
    if ($valoreMedio == 3) {
        return 10;
    } elseif ($valoreMedio >= 2.4) {
        return 9;
    } elseif ($valoreMedio >= 1.8) {
        return 8;
    } elseif ($valoreMedio >= 1.2) {
        return 7;
    } elseif ($valoreMedio >= 0.6) {
        return 6;
    } elseif ($valoreMedio >= 0) {
        return 5;
    } elseif ($valoreMedio >= -0.6) {
        return 4;
    } elseif ($valoreMedio >= -1.2) {
        return 3;
    } elseif ($valoreMedio >= -1.8) {
        return 2;
    } elseif ($valoreMedio >= -2.4) {
        return 1;
    } elseif ($valoreMedio >= -3) {
        return 0;
    }
}
