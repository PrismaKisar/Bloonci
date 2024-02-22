<?php
require "dbConnection.php";

// Email dell'utente
$emailUtenteLoggato = $_SESSION['email'];

// Query per selezionare gli amici dell'utente
$emailUtenteLoggato = $_SESSION['email'];
$sql = "SELECT IDMessaggio 
FROM messaggio 
WHERE email IN (
    SELECT utente.email
    FROM amicizia
    INNER JOIN utente ON (amicizia.emailRichiedente = utente.email AND amicizia.emailRicevitore = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
    OR (amicizia.emailRicevitore = utente.email AND amicizia.emailRichiedente = '$emailUtenteLoggato' AND amicizia.dataAccettazione IS NOT NULL)
    UNION
    SELECT '$emailUtenteLoggato' AS email)";
$result = $cid->query($sql);

echo "<select>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idMessaggio = $row["IDMessaggio"];
        echo "<option value='$idMessaggio'>$idMessaggio</option>";
    }
}
echo "</select>";
