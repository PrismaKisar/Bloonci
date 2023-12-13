<?php
require "backEnd/dbConnection.php";
session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['email'])) {
    // L'utente non è autenticato, gestisci di conseguenza (ad esempio, reindirizzalo alla pagina di login)
    header("Location: frontEnd/login.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloonci</title>
    <link rel="stylesheet" href="style/myStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="images/logo_bloonci_380x380.png" type="image/icon type">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/797b14a0a3.js" crossorigin="anonymous"></script>
    <script src="javaScript/util.js"></script>
    <script src="javaScript/autocomplete.js"></script>

</head>

<body style="background: #eeeeee;">

    <div class=" z-0 position-absolute container-fluid p-0">
        <!-- Navbar -->
        <div class="container-fluid" style="margin-bottom: 20px;">
            <!-- Navbar -->
            <nav class="navbar row" style="padding: 5px 20px; margin-bottom: 10px;">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="nav-left">
                        <img src="images/scritta_bloonci_bianca.png" class="logo">
                    </div>

                    <div class="search-container">
                        <div class="search-box mx-auto">
                            <img src="images/search.png" alt="Search Icon">
                            <input type="text" id="input-box" placeholder="Search">
                        </div>

                        <div class="z-1 position-absolute">
                            <div class="result-box" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); margin-top: 2px;">
                            </div>
                        </div>
                    </div>

                    <div class="nav-user-icon online">
                        <span>
                            <?php echo '<span class="nav-user-icon">' . $_SESSION['nome'] . ' ' . $_SESSION['cognome'] . '</span>'; ?>
                        </span>
                        <img src="images/notification.png" alt="Notification Icon">
                        <img src="images/unkwownPhoto.jpeg" alt="User Photo">
                    </div>
                </div>
            </nav>
        </div>

        <!-- Sezione Centrale -->
        <div class="container-fluid">
            <div class="row">

                <!-- Sidebar sinistra -->
                <div class="col-md-3 d-none d-md-block">
                    <div class="left-sidebar">

                        <!--   Statistiche    -->
                        <div class="sidebar-title">
                            <h4>Statistiche</h4>
                        </div>

                        <div class="stats">
                            <p> <i class="fa-solid fa-user"></i> Numero di amici:
                                <span>
                                    <?php include "backEnd/friendsNumber.php"; ?>
                                </span>
                            </p>
                            <p> <i class="fa-solid fa-chart-line"></i> Indice di Rispettabilità:
                                <span>
                                    <?php echo $_SESSION['rispettabilità'] ?>
                                </span>
                            </p>
                        </div>

                        <hr class="separator">

                        <!--  Amici  -->
                        <div class="sidebar-title">
                            <h4>Amici</h4>
                        </div>

                        <?php include "backEnd/friendList.php"; ?>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-6">
                    <div class="main-content">
                        <div class="write-post-container" style="height: 50%;">
                            <div class="user-profile">
                                <img src="images/unkwownPhoto.jpeg">
                                <div>
                                    <p>Alessandro Sarchi</p>
                                    <small>Public <i class="fa-solid fa-earth-americas"></i></small>
                                </div>
                            </div>

                            <div class="post-input-container">
                                <textarea rows="1" id="autoHeightTextarea" placeholder="Cos'hai in mente?"
                                    oninput="autoResize()"></textarea>
                            </div>
                        </div>

                        <div class="post-container">
                            <div class="user-profile">
                                <img src="images/unkwownPhoto.jpeg">
                                <div>
                                    <p>Marco Abbiati</p>
                                    <small>25 Luglio 2017, 13:45</small>
                                </div>
                            </div>
                            <p class="post-text">Ciao a tutti, come va oggi? per me molto bene dato che l'Inter ha
                                perso
                                lol
                            </p>
                            <img src="images/feed-image-1.png" class="post-img">

                            <!-- Utilizzo della griglia di Bootstrap per organizzare i like e i commenti -->

                        </div>

                    </div>
                </div>

                <!-- Sidebar destra -->
                <div class="col-md-3 d-none d-md-block">
                    <div class="right-sidebar">

                        <!--   Compleanni    -->
                        <div class="sidebar-title">
                            <h4>Compleanni</h4>
                        </div>
                        <?php include "backEnd/birthdays.php"; ?>

                        <hr class="separator">

                        <!--  Richieste di Amicizia  -->
                        <div class="sidebar-title">
                            <h4>Richieste di Amicizia</h4>
                        </div>
                        <?php include "backEnd/friendRequests.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>