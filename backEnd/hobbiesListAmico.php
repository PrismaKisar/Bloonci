<?php
try {
    $emailUtente = $_SESSION['emailBacheca'];
    $sql = "SELECT hobby.hobby
    FROM utente
    JOIN possiede ON utente.email = possiede.email
    JOIN hobby ON possiede.hobby = hobby.hobby
    WHERE utente.email = '$emailUtente';";
    $result = $cid->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='hobby-list'>";
            echo "" . $row['hobby'] . "";
            echo "</div>";
        }
    } else {
        echo "Non hai ancora nessun hobby";
    }
} catch (Exception $error) {
    echo $error;
}