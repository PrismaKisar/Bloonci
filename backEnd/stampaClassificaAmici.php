<?php
require "dbConnection.php";
session_start();

$emailUtenteLoggato = $_SESSION['email'];
$query = "SELECT u.email, u.nome, u.cognome, COUNT(DISTINCT c.IDCommento) AS num_commenti_positivi
FROM utente u
JOIN amicizia a ON (u.email = a.emailRichiedente OR u.email = a.emailRicevitore)
LEFT JOIN messaggio m ON u.email = m.email
LEFT JOIN commento c ON m.email = c.emailMessaggio AND m.timestamp = c.timestampMessaggio
LEFT JOIN gradimento g ON c.IDCommento = g.IDCommento AND g.indiceGradimento > 0
WHERE (a.emailRichiedente = '$emailUtenteLoggato' OR a.emailRicevitore = '$emailUtenteLoggato')
AND u.email != '$emailUtenteLoggato'
GROUP BY u.email, u.nome, u.cognome
ORDER BY num_commenti_positivi DESC
LIMIT 5;
";
echo <<<END
        <hr class="separator">
        <div class="sidebar-title">
            <h4>Amici con riscontro positivo</h4>
        </div>
    END;
$result = $cid->query($query);

if ($result->num_rows > 0) {
    $count = 1;

    while ($row = $result->fetch_assoc()) {
        $nome = $row['nome'];
        $cognome = $row['cognome'];
        echo <<<END
            $count. $nome $cognome <br>
        END;
        $count++;
    }
} else {
    "Non hai amici con gradimenti positivi";
}