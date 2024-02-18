<?php
require "dbConnection.php";

// Verifica se l'email esiste già
$email_to_check = $cid->real_escape_string($_POST["email"]);
$email_check_query = $cid->query("SELECT COUNT(*) as count FROM utente WHERE email = '$email_to_check'");
$email_exists_result = $email_check_query->fetch_assoc();

if (!empty($_POST['birth_date'])) {
    $birth_date = new DateTime($_POST['birth_date']);
    $now = new DateTime();
    $age = $now->diff($birth_date)->y;
    if ($age < 18) {
        header("Location: ../frontEnd/signup.php?error=underage");
        exit();
    }
}
if ($email_exists_result['count'] > 0) {
    header("Location: ../frontEnd/signup.php?error=exists");
    exit();
} else {
    $email = $cid->real_escape_string($_POST["email"]);
    $password = $cid->real_escape_string($_POST["password"]);
    $first_name = $cid->real_escape_string($_POST["first_name"]);
    $last_name = $cid->real_escape_string($_POST["last_name"]);
    $birth_date = $cid->real_escape_string($_POST["birth_date"]);
    $birth_city = $cid->real_escape_string($_POST["birth_city"]);
    $province = $cid->real_escape_string($_POST["province"]);
    $sex_orient = $cid->real_escape_string($_POST["sex_orient"]);

    try {
        $query = $cid->prepare("INSERT INTO `utente` (`email`, `password`, `nome`, `cognome`, `dataNascita`, `cittàNacita`, `provinciaNascita`, `orientamentoSessuale`, `rispettabilità`, `bloccante`, `amministratore`) 
        VALUES (?, ?, ?, ?, NULLIF(?, ''), NULLIF(?, ''), NULLIF(?, ''), NULLIF(?, ''), '6', NULL, '0')");
        $query->bind_param("ssssssss", $email, $password, $first_name, $last_name, $birth_date, $birth_city, $province, $sex_orient);

        $query->execute();

        if ($query->affected_rows > 0) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $first_name;
            $_SESSION['cognome'] = $last_name;

            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../frontEnd/signup.php?error=registration_failed");
            exit();
        }
    } catch (Exception $error) {
        echo $error;
    }
}
?>