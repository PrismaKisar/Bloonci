<?php
require "backEnd/dbConnection.php";
session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
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
    <script src="javaScript/pubblicaPost.js"></script>
    <script src="javaScript/gestioneValutazioni.js"></script>

</head>

<body style="background: #eeeeee;">

    <div class="z-0">
        <!-- Navbar -->
        <div class="container-fluid" style="margin-bottom: 20px;">
            <!-- Navbar -->
            <nav class="navbar row">
                <div class="container-fluid">
                    <img src="images/scritta_bloonci_bianca.png" class="logo nav-brand">

                    <div class="search-container">
                        <div class="search-box">
                            <img src="images/search.png" alt="Search Icon">
                            <input type="text" id="input-box" placeholder="Search">
                        </div>

                        <div class="z-1 position-absolute">
                            <div class="result-box" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); margin-top: 2px;">
                            </div>
                        </div>
                    </div>


                    <div style="display: flex; align-items: center;">
                        <div class="nav-user-icon d-none d-lg-block">
                            <span>
                                <?php echo '<span class="nav-user-icon">' . $_SESSION['nome'] . ' ' . $_SESSION['cognome'] . '</span>'; ?>
                            </span>
                        </div>

                        <div class="nav-user-icon d-none d-md-block">
                            <a href="frontEnd/bachecaPersonale.php">
                                <img src="images/unkwownPhoto.jpeg" alt="User Photo">
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
                                    <?php include "backEnd/getRispettabilità.php"; ?>
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
                                <div class="name-post">
                                    <p><a href="#">Alessandro Sarchi</a></p>
                                    <small>Public <i class=" fa-solid fa-earth-americas"></i></small>
                                </div>
                            </div>

                            <div class="post-input-container">
                                <textarea rows="1" id="autoHeightTextarea" placeholder="Cos'hai in mente?"
                                    oninput="autoResize()"></textarea>
                            </div>
                            <div>
                                <button class="request-button" id="pubblicaButton">pubblica</button>
                            </div>
                        </div>

                        <div class="post-container">
                            <div class="user-profile">
                                <img src="images/unkwownPhoto.jpeg">
                                <div class="name-post">
                                    <p><a href="#">Marco Abbiati</a></p>
                                    <small>25 Luglio 2017, 13:45 - Pavia (PV)</small>
                                </div>
                            </div>
                            <p class="post-text">Ciao a tutti, come va oggi? per me molto bene dato che l'Inter ha perso
                                lol
                            </p>
                            <img src="images/feed-image-1.png" class="post-img">
                            <div class="post-footer">
                                <select class="rating-dropdown">
                                    <option value="null">valuta</option>
                                    <option value="-3" data-email="email1@example.com" data-timestamp="2023-01-01">-3
                                    </option>
                                    <option value="-2" data-email="email1@example.com" data-timestamp="2023-01-01">-2
                                    </option>
                                    <option value="-1" data-email="email1@example.com" data-timestamp="2023-01-01">-1
                                    </option>
                                    <option value="0" data-email="email1@example.com" data-timestamp="2023-01-01">0
                                    </option>
                                    <option value="1" data-email="email1@example.com" data-timestamp="2023-01-01">1
                                    </option>
                                    <option value="2" data-email="email1@example.com" data-timestamp="2023-01-01">2
                                    </option>
                                    <option value="3" data-email="email1@example.com" data-timestamp="2023-01-01">3
                                    </option>
                                </select>
                                <div>
                                    <button>commenta</button>
                                </div>
                            </div>
                        </div>

                        <?php include "backEnd/allPosts.php" ?>
                    </div>
                </div>

                <!-- Sidebar destra -->
                <div class="col-md-3 d-none d-md-block">
                    <div class="right-sidebar">

                        <div class="logout">
                            <a href="backEnd/logout.php">Logout</a>
                        </div>

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
    <footer class="container-fluid text-center p-3" style="background: transparent; color: #b9b9b9;">
        <p>&copy; 2023 Bloonci - All rights reserved</p>
    </footer>
</body>

</html>