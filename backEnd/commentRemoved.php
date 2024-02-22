<?php

require "dbConnection.php";

try {
    // Ottieni l'ID del commento dalla richiesta POST
    $IDCommento = $_POST['IDCommento'];

    // Query per eliminare il commento dal database
    $sql = "DELETE FROM commento WHERE commento.IDCommento = '$IDCommento'";

    // Stampa la query per debug
    var_dump($sql);

    // Esegui la query di eliminazione
    $result = $cid->query($sql);
} catch (Exception $error) {
    // Gestione delle eccezioni
    echo $error; // Stampa eventuali errori
}
?>