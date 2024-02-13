<?php

require "dbConnection.php";


$sql = "SELECT DISTINCT hobby FROM hobby";
$result = $cid->query($sql);

if ($result->num_rows > 0) {
    echo '<option value=""></option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['hobby'] . '">' . $row['hobby'] . '</option>';
    }
} else {
    echo '<option value=""></option>';
}
