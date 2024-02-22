<?php

require "dbConnection.php";

// Verifica se l'email esiste già nel database
$email_to_check = $cid->real_escape_string($_POST["email"]);
$email_check_query = $cid->query("SELECT COUNT(*) as count FROM utente WHERE email = '$email_to_check'");
$email_exists_result = $email_check_query->fetch_assoc();

// Verifica se l'utente è minorenne
if (!empty($_POST['birth_date'])) {
    $birth_date = new DateTime($_POST['birth_date']);
    $now = new DateTime();
    $age = $now->diff($birth_date)->y;
    if ($age < 18) {
        // Se l'utente è minorenne, reindirizzalo alla pagina di registrazione con un messaggio di errore
        header("Location: ../frontEnd/signup.php?error=underage");
        exit();
    }
}

// Se l'email esiste già nel database, reindirizza l'utente alla pagina di registrazione con un messaggio di errore
if ($email_exists_result['count'] > 0) {
    header("Location: ../frontEnd/signup.php?error=exists");
    exit();
} else {
    // Se l'email non esiste nel database, procedi con la registrazione dell'utente
    $email = $cid->real_escape_string($_POST["email"]);
    $password = $cid->real_escape_string($_POST["password"]);
    $first_name = $cid->real_escape_string($_POST["first_name"]);
    $last_name = $cid->real_escape_string($_POST["last_name"]);
    $birth_date = $cid->real_escape_string($_POST["birth_date"]);
    $birth_city = $cid->real_escape_string($_POST["birth_city"]);
    $province = $cid->real_escape_string($_POST["province"]);
    $sex_orient = $cid->real_escape_string($_POST["sex_orient"]);

    try {
        // Prepara la query di inserimento dell'utente nel database
        $query = $cid->prepare("INSERT INTO `utente` (`email`, `password`, `nome`, `cognome`, `dataNascita`, `cittàNacita`, `provinciaNascita`, `orientamentoSessuale`, `rispettabilità`, `bloccante`, `amministratore`) 
        VALUES (?, ?, ?, ?, NULLIF(?, ''), NULLIF(?, ''), NULLIF(?, ''), NULLIF(?, ''), '6', NULL, '0')");
        // Associa i parametri alla query
        $query->bind_param("ssssssss", $email, $password, $first_name, $last_name, $birth_date, $birth_city, $province, $sex_orient);

        // Esegui la query di inserimento
        $query->execute();

        // Verifica se l'inserimento è stato eseguito con successo
        if ($query->affected_rows > 0) {
            // Avvia la sessione per l'utente appena registrato e reindirizzalo alla pagina principale
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $first_name;
            $_SESSION['cognome'] = $last_name;

            header("Location: ../index.php");
            exit();
        } else {
            // Se l'inserimento non è riuscito, reindirizza l'utente alla pagina di registrazione con un messaggio di errore
            header("Location: ../frontEnd/signup.php?error=registration_failed");
            exit();
        }
    } catch (Exception $error) {
        // Gestione delle eccezioni
        echo $error; // Mostra eventuali errori
    }
}
