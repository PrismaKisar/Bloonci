<?php
require "dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$query = "SELECT u.nome, u.cognome, COUNT(g.indiceGradimento) AS num_commenti_positivi
FROM utente u
JOIN gradimento g ON u.email = g.emailGradimento
WHERE g.indiceGradimento > 0 AND u.email != '$emailUtenteLoggato'
GROUP BY u.email
ORDER BY num_commenti_positivi DESC
LIMIT 5;";

$result = $cid->query($query);
if ($result->num_rows > 0) {
    $count = 1;
    echo <<<END
        <hr class="separator">
        <div class="sidebar-title">
            <h4>Statistiche Amici</h4>
        </div>
    END;

    while ($row = $result->fetch_assoc()) {
        $nome = $row['nome'];
        $cognome = $row['cognome'];
        echo <<<END
            $count. $nome $cognome <br>
        END;
        $count++;
    }
}