<?php
require "dbConnection.php";

try {
    $IDCommento = $_POST['IDCommento'];
    $sql = "DELETE FROM commento WHERE commento.IDCommento = '$IDCommento'";
    var_dump($sql);
    $result = $cid->query($sql);
} catch (Exception $error) {
    echo $error;
}

