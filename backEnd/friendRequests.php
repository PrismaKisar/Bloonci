<?php
try {
    // Recupera l'email dell'utente loggato dalla sessione
    $emailUtenteLoggato = $_SESSION['email'];

    // Query per selezionare le richieste di amicizia ricevute dall'utente loggato
    $sql = "SELECT utente.nome, utente.cognome, utente.email
            FROM amicizia
            INNER JOIN utente ON amicizia.emailRichiedente = utente.email
            WHERE amicizia.emailRicevitore = '$emailUtenteLoggato'
            AND amicizia.dataAccettazione IS NULL";

    // Esegui la query
    $result = $cid->query($sql);

    // Verifica se ci sono risultati
    if ($result->num_rows > 0) {
        // Loop attraverso ogni risultato e stampa le informazioni sulla richiesta di amicizia
        while ($row = $result->fetch_assoc()) {
            echo "<div class='request-list'>";
            echo "  <img class='d-none d-lg-block' src='images/misc/unkwownPhoto.jpeg' alt='User Photo'>";
            echo "  <div class='request-info'>";
            echo "      <h4><a href='frontEnd/bachecaAmico.php?emailCorrente=" . $row['email'] . "'>" . $row['nome'] . " " . $row['cognome'] . "</a></h4>";
            echo "      <div class='buttons-container'>";
            echo "          <button class='accept-btn' onclick='friendshipAccepted(\"{$emailUtenteLoggato}\", \"{$row['email']}\")'><i class='fas fa-check'></i></button>";
            echo "          <button class='reject-btn' onclick='friendshipDenied(\"{$emailUtenteLoggato}\", \"{$row['email']}\")'><i class='fas fa-times'></i></button>";
            echo "      </div>";
            echo "   </div>";
            echo "</div>";
        }
    } else {
        // Messaggio se non ci sono richieste di amicizia
        echo "<p>Nessuna richiesta di amicizia.</p>";
    }
} catch (Exception $error) {
    // Gestione delle eccezioni in caso di errore
    echo $error;
}
?>