<?php

require "dbConnection.php";

if (isset($_POST['province']) && $_POST['province'] !== "") {
    $selectedProvince = $_POST['province'];
    $sql = "SELECT DISTINCT città FROM città WHERE provincia = '$selectedProvince'";
} else {
    $sql = "SELECT DISTINCT città FROM città";
}

$result = $cid->query($sql);

if ($result->num_rows > 0) {
    echo '<option value="" selected hidden disabled>Città</option>';
    echo '<option value=""></option>';

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['città'] . '">' . $row['città'] . '</option>';
    }
} else {
    echo '<option value=""></option>';
}
