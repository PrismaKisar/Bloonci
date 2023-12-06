<?php
try {
    // Esegui la query per ottenere le richieste di amicizia
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT utente.nome, utente.cognome
        FROM amicizia
        INNER JOIN utente ON amicizia.emailRichiedente = utente.email
        WHERE amicizia.emailRicevitore = '$emailUtenteLoggato'
        AND amicizia.dataAccettazione IS NULL";
    $result = $cid->query($sql);

    // Visualizza dinamicamente le richieste di amicizia
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='request-list row'>";
            echo "<div class='col-md-2'>";
            echo "<img src='images/unkwownPhoto.jpeg'>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo "<h4>".$row['nome']." ".$row['cognome']."</h4>";
            echo "</div>";
            echo "<div class='col-md-1'>";
            echo "<button class='request-btn accept-btn'><i class='fas fa-check'></i></button>";
            echo "</div>";
            echo "<div class='col-md-1'></div>";
            echo "<div class='col-md-1'>";
            echo "<button class='request-btn reject-btn'><i class='fas fa-times'></i></button>";
            echo "</div>";
            echo "<div class='col-md-1'></div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nessuna richiesta di amicizia.</p>";
    }
} catch (Exception $error) {
    echo $error;
}
?>