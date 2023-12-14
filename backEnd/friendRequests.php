<?php
try {
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT utente.nome, utente.cognome, utente.email
        FROM amicizia
        INNER JOIN utente ON amicizia.emailRichiedente = utente.email
        WHERE amicizia.emailRicevitore = '$emailUtenteLoggato'
        AND amicizia.dataAccettazione IS NULL";
    $result = $cid->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='request-list'>";
            echo "  <img src='images/unkwownPhoto.jpeg' alt='User Photo'>";
            echo "  <div class='request-info'>";
            echo "      <h4>" . $row['nome'] . " " . $row['cognome'] . "</h4>";
            echo "      <div class='buttons-container'>";
            echo "          <button class='accept-btn' onclick='friendshipAccepted(\"{$emailUtenteLoggato}\", \"{$row['email']}\")'><i class='fas fa-check'></i></button>";
            echo "          <button class='reject-btn' onclick='friendshipDenied(\"{$emailUtenteLoggato}\", \"{$row['email']}\")'><i class='fas fa-times'></i></button>";
            echo "      </div>";
            echo "   </div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nessuna richiesta di amicizia.</p>";
    }
} catch (Exception $error) {
    echo $error;
}
?>