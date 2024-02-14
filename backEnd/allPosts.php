<?php
require "dbConnection.php";
session_start();

$query = "SELECT m.*, u.nome AS nome_amico, u.cognome AS cognome_amico
          FROM messaggio AS m
          JOIN utente AS u ON m.email = u.email
          WHERE m.email IN (
              SELECT emailRicevitore FROM amicizia WHERE emailRichiedente = '$emailUtenteLoggato'
              UNION
              SELECT emailRichiedente FROM amicizia WHERE emailRicevitore = '$emailUtenteLoggato'
              UNION
              SELECT '$emailUtenteLoggato'
          )
          ORDER BY m.timestamp DESC;";

$result = $cid->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $testo = $row['testo'];
        $email = $row['email'];
        $timestamp = $row['timestamp'];
        $tipo = $row['tipo'];
        $nomeAmico = $row['nome_amico'];
        $cognomeAmico = $row['cognome_amico'];

        if ($tipo == "testo") {
            echo "<div class='post-container'>";
            echo "  <div class='user-profile'>";
            echo "      <img src='images/unkwownPhoto.jpeg'>";
            echo "      <div class='name-post'>";
            echo "          <p><a href='#'>" . $nomeAmico . " " . $cognomeAmico . "</a></p>";
            echo "          <small>" . $timestamp . "</small>";
            if ($email == $emailUtenteLoggato) {
                echo "<button>rimuovi</button>";
            }
            echo "      </div>";
            echo "  </div>";
            echo "  <p class='post-text'>" . $testo . "</p>";
            echo "</div>";
        } else {

        }
    }
} else {
    echo "Nessun post trovato.";
}
