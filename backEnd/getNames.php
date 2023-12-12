<?php
require "dbConnection.php";
session_start();

// Ottieni la lista di nomi con l'informazione sull'amicizia
$loggedUserEmail = $_SESSION['email'];
$sql = "SELECT u.email, CONCAT(u.nome, ' ', u.cognome) AS nome_completo,
               CASE WHEN a.emailRichiedente = '$loggedUserEmail' OR a.emailRicevitore = '$loggedUserEmail' THEN 'amico' ELSE 'non amico' END AS stato_amicizia
        FROM utente u
        LEFT JOIN amicizia a ON (u.email = a.emailRichiedente OR u.email = a.emailRicevitore)
                             AND (a.emailRichiedente = '$loggedUserEmail' OR a.emailRicevitore = '$loggedUserEmail')
        WHERE u.email != '$loggedUserEmail'";
$result = $cid->query($sql);

$names = array();
while ($row = $result->fetch_assoc()) {

    $names[] = array(
        'nome_completo' => $row['nome_completo'],
        'stato_amicizia' => $row['stato_amicizia']
    );
}
//var_dump($names);
// Restituisci la lista come JSON
echo json_encode($names);

// ... Altri codici ...
?>