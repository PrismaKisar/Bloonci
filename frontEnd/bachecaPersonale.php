<?php
require "../backEnd/dbConnection.php";
session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$emailUtenteLoggato = $_SESSION['email'];
$query = "SELECT bloccante FROM utente WHERE email = '$emailUtenteLoggato'";
$result = $cid->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $bloccante = $row['bloccante'];
    if ($bloccante === null) {
    } else {
        header("Location: homeBloccata.php");
    }
} else {
    echo "Errore nella query: " . $cid->error;
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
    <script src="../javaScript/utilBacheca.js"></script>
    <script src="../javaScript/autocompleteBacheca.js"></script>
    <script src="../javaScript/citiesAndProvinces.js"></script>
    <script src="../javaScript/modal.js"></script>
    <script src="../javaScript/gestioneModifiche.js"></script>
    <script src="../javaScript/gestioneValutazioni.js"></script>
    <script src="../javaScript/bloccaUtente.js"></script>
    <script src="../javaScript/modalCommentoAmico.js"></script>
    <script src="../javaScript/modalVisualize.js"></script>
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

                    <div class="search-container">
                        <div class="search-box">
                            <img src="../images/misc/search.png" alt="Search Icon">
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

                    <div class="left-sidebar">
                        <!--  Amici  -->
                        <div class="sidebar-title">
                            <h4>Amici</h4>
                        </div>
                        <?php include "../backEnd/friendListBacheca.php"; ?>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-6">
                    <div class="main-content">
                        <?php include "../backEnd/allPostsPersonale.php"; ?>
                    </div>
                </div>

                <!-- Sidebar destra -->
                <div class="col-md-3 d-none d-md-block">
                    <div class="right-sidebar">
                        <div class="sidebar-title">
                            <h4 style="margin-bottom: 0px;">Informazioni</h4>
                        </div>
                        <?php include "../backEnd/infoList.php"; ?>

                        <hr class="separator">
                        <div class=" sidebar-title">
                            <h4>Hobby</h4>
                        </div>
                        <?php include "../backEnd/hobbiesList.php"; ?>

                        <button class="modalButtonAggiungi" id="openModalBtnHobby">Aggiungi</button>



                        <div id="modalNome" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifica nome e cognome</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" id="nomeModal" class="form-control mb-3" placeholder="Nome">
                                        <input type="text" id="cognomeModal" class="form-control mb-3"
                                            placeholder="Cognome">
                                    </div>
                                    <div class="modal-footer">
                                        <button id="salvaModificheNomeBtn" class="btn btn-primary">Salva
                                            modifiche</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modalDataNascita" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifica data di nascita</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="date" id="birthModal" class="form-control" />
                                    </div>
                                    <div class="modal-footer">
                                        <button id="salvaModificheDataNascitaBtn" class="btn btn-primary">Salva
                                            modifiche</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modalLuogoNascita" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifica provincia e città</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select id="province" class="form-select" name="province">
                                                    <option value=""></option>
                                                    <?php include "../backEnd/getProvinces.php" ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="birth_city" class="form-select" name="birth_city">
                                                    <?php include "../backEnd/getCities.php" ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="salvaModificheLuogoBtn" class="btn btn-primary">Salva
                                            modifiche</button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div id="modalOrientamento" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifica orientamento sessuale</h5>
                                    </div>
                                    <div class="modal-body">
                                        <select id="orientamentoModal" class="form-select">
                                            <option selected></option>
                                            <option value="eterosessuale">eterosessuale</option>
                                            <option value="omosessuale">omosessuale</option>
                                            <option value="bisessuale">bisessuale</option>
                                            <option value="altro">altro</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="salvaModificheOrientBtn" class="btn btn-primary">Salva
                                            modifiche</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalHobby" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Aggiungi hobby</h5>
                        </div>
                        <div class="modal-body">
                            <select id="hobbyModal" class="form-select">
                                <?php include "../backEnd/getHobbies.php"; ?>
                            </select>

                        </div>
                        <div class="modal-footer">
                            <button id="aggiungiHobbyBtn" class="btn btn-primary">Aggiungi</button>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="container-fluid text-center p-3" style="background: transparent; color: #b9b9b9;">
                <p>&copy; 2023 Bloonci - All rights reserved</p>
            </footer>
            <script>

            </script>

        </div>
    </div>
</body>

</html>