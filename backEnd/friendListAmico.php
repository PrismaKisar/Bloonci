<?php
try {
    // Recupera l'email dell'utente della bacheca dalla sessione
    $emailUtente = $_SESSION['emailBacheca'];

    // Query per selezionare gli amici dell'utente della bacheca
    $sql = "SELECT utente.nome, utente.cognome, utente.email
            FROM amicizia
            INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtente' AND amicizia.dataAccettazione IS NOT NULL)
            OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtente' AND amicizia.dataAccettazione IS NOT NULL);";

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
            echo "  </div>";
            echo "</div>";
        }
    } else {
        // Messaggio se l'utente della bacheca non ha ancora amici
        echo "<div>Non ha ancora nessun amico</div>";
    }
} catch (Exception $error) {
    // Gestione delle eccezioni in caso di errore
    echo $error;
}
?>