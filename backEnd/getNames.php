<?php
require "dbConnection.php";
session_start();

$loggedUserEmail = $_SESSION['email'];
$sql = "SELECT u.email, CONCAT(u.nome, ' ', u.cognome) AS nome_completo,
            CASE
                WHEN a.dataAccettazione IS NOT NULL THEN 'amico'
                WHEN a.emailRichiedente = '$loggedUserEmail' AND a.dataAccettazione IS NULL THEN 'inviata'
                WHEN a.emailRicevitore = '$loggedUserEmail' AND a.dataAccettazione IS NULL THEN 'accetta'
                ELSE 'non amico'
        END AS stato_amicizia
            FROM utente u
            LEFT JOIN amicizia a ON (u.email = a.emailRichiedente OR u.email = a.emailRicevitore)
            AND (a.emailRichiedente = '$loggedUserEmail' OR a.emailRicevitore = '$loggedUserEmail')
            WHERE u.email != '$loggedUserEmail';
        ";
$result = $cid->query($sql);

$names = array();
while ($row = $result->fetch_assoc()) {
    $names[] = array(
        'nome_completo' => $row['nome_completo'],
        'stato_amicizia' => $row['stato_amicizia'],
        'email' => $row['email'],
        'email_sessione' => $loggedUserEmail
    );
}

echo json_encode($names);