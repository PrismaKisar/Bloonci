<?php
try {
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT hobby.hobby
    FROM utente
    JOIN possiede ON utente.email = possiede.email
    JOIN hobby ON possiede.hobby = hobby.hobby
    WHERE utente.email = '$emailUtenteLoggato';";
    $result = $cid->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='hobby-list'>";
            echo "<div>" . $row['hobby'] . "</div>";
            echo "      <div class='buttons-container'>";
            echo "          <button class='remove-btn' onclick='hobbyRemoved(\"{$row['hobby']}\")'>rimuovi</button>";
            echo "      </div>";
            echo "</div>";
        }
    } else {
        echo "Non hai ancora nessun hobby";
    }
} catch (Exception $error) {
    echo $error;
}