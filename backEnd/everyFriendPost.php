<?php

require "dbConnection.php";

// Email dell'utente loggato
$emailUtenteLoggato = $_SESSION['email'];

try {
    // Query per selezionare gli ID dei messaggi degli amici dell'utente
    $sql = "SELECT IDMessaggio 
            FROM messaggio 
            WHERE email IN (
                SELECT utente.email
                FROM amicizia
                INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
                OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
                UNION
                SELECT '$emailUtenteLoggato' AS email)";

    // Esegui la query
    $result = $cid->query($sql);

    // Stampare un menu a discesa con gli ID dei messaggi degli amici
    echo "<select>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idMessaggio = $row["IDMessaggio"];
            echo "<option value='$idMessaggio'>$idMessaggio</option>";
        }
    }
    echo "</select>";
} catch (Exception $error) {
    // Gestione delle eccezioni in caso di errore
    echo $error;
}
?>