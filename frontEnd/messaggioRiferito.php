<?php
require "../backEnd/dbConnection.php";
session_start();

$_SESSION['emailBacheca'] = $_GET['emailCorrente'];


if (!isset($_SESSION['email'])) {
    header("Location: ../frontEnd/login.html");
    exit();
}

if ($_GET['emailCorrente'] == $_SESSION['email']) {
    header("Location: bachecaPersonale.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloonci</title>
    <link rel="stylesheet" href="../style/myStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="../images/misc/logo_bloonci_380x380.png" type="image/icon type">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/797b14a0a3.js" crossorigin="anonymous"></script>
    <script src="../javaScript/util.js"></script>

</head>

<body style="background: #eeeeee;">

    <div class="z-0">
        <!-- Navbar -->
        <div class="container-fluid" style="margin-bottom: 20px;">
            <!-- Navbar -->
            <nav class="navbar row">
                <div class="container-fluid">
                    <a href="../index.php">
                        <img src="../images/misc/scritta_bloonci_bianca.png" class="logo nav-brand">
                    </a>
                    <div style="display: flex; align-items: center;">
                        <div class="nav-user-icon d-none d-lg-block">
                            <span>
                                <?php echo '<span class="nav-user-icon">' . $_SESSION['nome'] . ' ' . $_SESSION['cognome'] . '</span>'; ?>
                            </span>
                        </div>

                        <div class="nav-user-icon d-none d-md-block">
                            <a href="bachecaPersonale.php">
                                <img src="../images/misc/unkwownPhoto.jpeg" alt="User Photo">
                            </a>
                        </div>
                    </div>

                </div>
            </nav>
        </div>

        <!-- Sezione Centrale -->
        <div class="container-fluid">
            <div class="row">

                <!-- Sidebar sinistra -->
                <div class="col-md-3 d-none d-md-block">

                </div>

                <!-- Main Content -->
                <div class="col-md-6">
                    <div class="main-content">

                        <?php
                        $IDMessaggio = $_GET['IDMessaggio'];
                        $query = "SELECT * FROM messaggio WHERE IDMessaggio = '$IDMessaggio'";
                        $res = $cid->query($query);
                        $row = $res->fetch_assoc();
                        $testo = $row['testo'];
                        $email = $row['email'];
                        $timestamp = $row['timestamp'];
                        $tipo = $row['tipo'];
                        $testo = $row['testo'];

                        $query2 = "SELECT nome, cognome FROM utente WHERE email = '$email'";
                        $res2 = $cid->query($query2);
                        $row2 = $res2->fetch_assoc();
                        $nomeUtente = $row2['nome'];
                        $cognome = $row2['cognome'];


                        echo <<<END
                        <div class="post-container">
                            <div class="user-profile">
                                <div style="display: flex">
                                    <div class="name-post">
                                        <p><a href="">$nomeUtente $cognome</a></p>
                                        <small>$timestamp</small>
                                    </div>
                                </div>
                            </div>
                            <p class="post-text">$testo</p>
                            
                        END;

                        if ($tipo == "foto") {
                            $nome = $row['nome'];
                            $percorso = $row['percorso'];
                            echo "<img src='../$percorso$nome' class='post-img'>";
                        }
                        echo <<<END
                        </div>
                        END;
                        ?>
                    </div>
                </div>


                <!-- Sidebar destra -->
                <div class="col-md-3 d-none d-md-block">

                </div>
            </div>
        </div>
        <footer class="container-fluid text-center p-3" style="background: transparent; color: #b9b9b9;">
            <p>&copy; 2023 Bloonci - All rights reserved</p>
        </footer>
</body>

</html>