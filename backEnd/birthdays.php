<?php
try {
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT 
    DAY(u.dataNascita) AS giorno_compleanno,
    MONTHNAME(u.dataNascita) AS mese_compleanno,
    CONCAT(u.nome, ' ', u.cognome) AS nome_completo,
    YEAR(CURDATE()) - YEAR(u.dataNascita) AS anni_compie
FROM 
    utente u
JOIN 
    amicizia a ON u.email = a.emailRichiedente OR u.email = a.emailRicevitore
WHERE 
    ((a.emailRichiedente = '$emailUtenteLoggato' OR a.emailRicevitore = '$emailUtenteLoggato') AND a.dataAccettazione IS NOT NULL)
    AND (DATE_ADD(u.dataNascita, INTERVAL (YEAR(CURDATE()) - YEAR(u.dataNascita)) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH))
    AND u.email != '$emailUtenteLoggato';";
    $result = $cid->query($sql);

    // Visualizza dinamicamente le richieste di amicizia
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class=\"birthday\">";
            echo "  <div class=\"left-birthday\">";
            echo "      <h3>" . $row['giorno_compleanno'] . "</h3>";
            echo "      <span>" . $row['mese_compleanno'] . "</span>";
            echo "  </div>";
            echo "  <div class=\"right-birthday\">";
            echo "      <h4>" . $row['nome_completo'] . "</h4>";
            echo "      <p> <i class=\"fa-solid fa-cake-candles\"></i> compie " . $row['anni_compie'] . " anni</p>";
            echo "  </div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nessun compleanno nel prossimo mese!</p>";
    }
} catch (Exception $error) {
    echo $error;
}
?>