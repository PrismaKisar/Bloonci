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
    <link rel="icon" href="../images/logo_bloonci_380x380.png" type="image/icon type">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/797b14a0a3.js" crossorigin="anonymous"></script>
    <script src="../javaScript/util.js"></script>
    <script src="../javaScript/autocompleteBacheca.js"></script>
    <script src="../javaScript/gestioneValutazioneAmico.js"></script>
</head>

<body style="background: #eeeeee;">

    <div class="z-0">
        <!-- Navbar -->
        <div class="container-fluid" style="margin-bottom: 20px;">
            <!-- Navbar -->
            <nav class="navbar row">
                <div class="container-fluid">
                    <a href="../index.php">
                        <img src="../images/scritta_bloonci_bianca.png" class="logo nav-brand">
                    </a>

                    <div class="search-container">
                        <div class="search-box">
                            <img src="../images/search.png" alt="Search Icon">
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
                            <a href="bachecaPersonale.php">
                                <img src="../images/unkwownPhoto.jpeg" alt="User Photo">
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
                        <!--  Amici  -->
                        <div class="sidebar-title">
                            <h4>Amici</h4>
                        </div>
                        <?php include "../backEnd/friendListAmico.php"; ?>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-6">
                    <div class="main-content">
                        <?php include "../backEnd/allPostsAmico.php"; ?>
                    </div>
                </div>

                <!-- Sidebar destra -->
                <div class="col-md-3 d-none d-md-block">
                    <div class="right-sidebar">
                        <div class="sidebar-title">
                            <h4 style="margin-bottom: 0px;">Informazioni</h4>
                        </div>
                        <?php include "../backEnd/infoListAmico.php"; ?>
                        <hr class="separator">
                        <div class=" sidebar-title">
                            <h4>Hobby</h4>
                        </div>
                        <?php include "../backEnd/hobbiesListAmico.php"; ?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="container-fluid text-center p-3" style="background: transparent; color: #b9b9b9;">
            <p>&copy; 2023 Bloonci - All rights reserved</p>
        </footer>
</body>

</html>