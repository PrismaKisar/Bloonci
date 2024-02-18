<?php
try {
    $emailUtente = $_SESSION['emailBacheca'];
    $sql = "SELECT utente.nome, utente.cognome, utente.email
            FROM amicizia
            INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtente' AND amicizia.dataAccettazione IS NOT NULL)
            OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtente' AND amicizia.dataAccettazione IS NOT NULL);";
    $result = $cid->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='friend-list'>";
            echo "  <img class='d-none d-lg-block' src='../images/unkwownPhoto.jpeg'>";
            echo "  <div class='request-info'>";
            echo "      <h4><a href='../frontEnd/bachecaAmico.php?emailCorrente=" . $row['email'] . " ''>" . $row['nome'] . " " . $row['cognome'] . "</a></h4>";
            echo "  </div>";
            echo "</div>";
        }
    } else {
        echo "<div>Non ha ancora nessun amico</div>";
    }
} catch (Exception $error) {
    echo $error;
}