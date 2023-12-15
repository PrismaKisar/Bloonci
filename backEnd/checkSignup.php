<?php
require "dbConnection.php";

// Verifica se l'email esiste già
$email_to_check = $cid->real_escape_string($_POST["email"]);
$email_check_query = $cid->query("SELECT COUNT(*) as count FROM utente WHERE email = '$email_to_check'");
$email_exists_result = $email_check_query->fetch_assoc();

if ($email_exists_result['count'] > 0) {
    header("Location: ../frontEnd/signup.html?error=exists");
    exit();
} else {
    $email = $cid->real_escape_string($_POST["email"]);
    $password = $cid->real_escape_string($_POST["password"]);
    $first_name = $cid->real_escape_string($_POST["first_name"]);
    $last_name = $cid->real_escape_string($_POST["last_name"]);
    $birth_date = setOrDefault("birth_date", $cid);
    $birth_city = setOrDefault("birth_city", $cid);
    $province = setOrDefault("province", $cid);
    $sex_orient = setOrDefault("sex_orient", $cid);

    $query = $cid->prepare("INSERT INTO `utente` (`email`, `password`, `nome`, `cognome`, `dataNascita`, `cittàNacita`, `provinciaNascita`, `orientamentoSessuale`, `rispettabilità`, `bloccante`) 
                            VALUES ('$email', '$password', '$first_name', '$last_name', '$birth_date', '$birth_city', '$province', '$sex_orient', '6', NULL)");

    try {
        $query->execute();

        if ($query->affected_rows > 0) {
            session_start();
            $_SESSION['email'] = $cid->real_escape_string($_POST['email']);
            $_SESSION['nome'] = $cid->real_escape_string($_POST['first_name']);
            $_SESSION['cognome'] = $cid->real_escape_string($_POST['last_name']);

            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../frontEnd/signup.html?error=registration_failed");
            exit();
        }
    } catch (Exception $error) {
        echo $error;
    }
}

function setOrDefault($value, $cid)
{
    if (isset($_POST[$value]) && $_POST[$value] !== '') {
        return $cid->real_escape_string($_POST[$value]);
    } else {
        return null;
    }
}
?>