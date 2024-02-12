<?php
try {
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT utente.nome, utente.cognome, utente.email
            FROM amicizia
            INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
            OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL);";
    $result = $cid->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='friend-list'>";
            echo "  <img class='d-none d-lg-block' src='../images/unkwownPhoto.jpeg'>";
            echo "  <div class='request-info'>";
            echo "      <h4><a href=\"\">" . $row['nome'] . " " . $row['cognome'] . "</a></h4>";
            echo "      <div class='buttons-container'>";
            echo "          <button class='remove-btn' onclick='friendshipRemoved(\"{$emailUtenteLoggato}\", \"{$row['email']}\")'>rimuovi</button>";
            echo "      </div>";
            echo "  </div>";
            echo "</div>";
        }
    } else {
        echo "<p>Non hai ancora nessun amico, invia la richiesta a qualcuno!</p>";
    }
} catch (Exception $error) {
    echo $error;
}