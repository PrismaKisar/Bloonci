<?php
try {
    // Recupera l'email dell'utente loggato dalla sessione
    $emailUtenteLoggato = $_SESSION['email'];

    // Query per selezionare gli amici dell'utente loggato
    $sql = "SELECT utente.nome, utente.cognome, utente.email
            FROM amicizia
            INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
            OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL);";

    // Esegui la query
    $result = $cid->query($sql);

    // Verifica se ci sono risultati
    if ($result->num_rows > 0) {
        // Loop attraverso ogni risultato e stampa le informazioni dell'amico
        while ($row = $result->fetch_assoc()) {
            echo "<div class='friend-list'>";
            echo "  <img class='d-none d-lg-block' src='../images/misc/unkwownPhoto.jpeg'>";
            echo "  <div class='request-info'>";
            echo "      <h4><a href='../frontEnd/bachecaAmico.php?emailCorrente=" . $row['email'] . "'>" . $row['nome'] . " " . $row['cognome'] . "</a></h4>";
            echo "      <div class='buttons-container'>";
            echo "          <button class='remove-btn' onclick='friendshipRemoved(\"{$emailUtenteLoggato}\", \"{$row['email']}\")'>rimuovi</button>";
            echo "      </div>";
            echo "  </div>";
            echo "</div>";
        }
    } else {
        // Messaggio se l'utente loggato non ha ancora amici
        echo "<p>Non hai ancora nessun amico, invia la richiesta a qualcuno!</p>";
    }
} catch (Exception $error) {
    // Gestione delle eccezioni in caso di errore
    echo $error;
}
?>