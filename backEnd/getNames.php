<?php
require "dbConnection.php";

// Recupera tutti i nomi dalla tabella utente
$sqlNomi = "SELECT CONCAT(nome, ' ', cognome) AS nomeCompleto FROM utente";
$resultNomi = $cid->query($sqlNomi);

// Verifica se ci sono risultati
if ($resultNomi->num_rows > 0) {
    // Inizializza l'array per gli availableKeywords
    $availableKeywords = array();

    // Itera sui risultati e aggiungi i nomi all'array
    while ($rowNome = $resultNomi->fetch_assoc()) {
        $availableKeywords[] = $rowNome['nomeCompleto'];
    }
} else {
    // Nessun risultato trovato, gestisci di conseguenza
    $availableKeywords = array();
}

// Restituisci l'array come JSON
echo json_encode($availableKeywords);
?>