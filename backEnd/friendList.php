<?php
try {
    // Esegui la query per ottenere le richieste di amicizia
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT utente.nome, utente.cognome
            FROM amicizia
            INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
            OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL);";
    $result = $cid->query($sql);



    // Visualizza dinamicamente le richieste di amicizia
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='request-list'>";
            echo "<img src='images/unkwownPhoto.jpeg'>";
            echo "<h4>" . $row['nome'] . " " . $row['cognome'] . "</h4>";
            echo "</div>";
        }
    } else {
        echo "<p>Non hai ancora nessun amico, invia la richiesta a qualcuno!</p>";
    }
} catch (Exception $error) {
    echo $error;
}