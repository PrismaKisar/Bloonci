<?php
// getProvinces.php

require "dbConnection.php";

if (isset($_POST['city']) && $_POST['city'] !== "") {
    $selectedCity = $_POST['city'];
    $sql = "SELECT DISTINCT provincia FROM città WHERE città = '$selectedCity'";
} else {
    $sql = "SELECT DISTINCT provincia FROM città";
}

$result = $cid->query($sql);

if ($result->num_rows > 0) {
    if ($_POST['city'] === "") {
        echo '<option value=""></option>';
    }
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['provincia'] . '">' . $row['provincia'] . '</option>';
    }
} else {
    echo '<option value=""></option>';
}
