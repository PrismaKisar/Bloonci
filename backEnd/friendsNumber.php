<?php
require "dbConnection.php";
$emailUtente = $_SESSION['email'];
$sql = "SELECT COUNT(*) AS numAmici
        FROM amicizia
        WHERE (emailRichiedente = '$emailUtente'
        OR emailRicevitore = '$emailUtente')
        AND dataAccettazione IS NOT NULL";
$result = $cid->query($sql);
$row = $result->fetch_assoc();

echo $row['numAmici'];