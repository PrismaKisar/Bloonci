<?php
require "backEnd/dbConnection.php";
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
    header("Location: frontEnd/homeBloccata.php");
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
  <link rel="stylesheet" href="style/myStyle.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="icon" href="images/misc/logo_bloonci_380x380.png" type="image/icon type">
  <script src="https://kit.fontawesome.com/797b14a0a3.js" crossorigin="anonymous"></script>
  <script src="javaScript/util.js"></script>
  <script src="javaScript/autocomplete.js"></script>
  <script src="javaScript/pubblicaPost.js"></script>
  <script src="javaScript/gestioneValutazioni.js"></script>
  <script src="javaScript/modalCommento.js"></script>
  <script src="javaScript/modalVisualize.js"></script>
  <script src="javaScript/citiesAndProvincesIndex.js"></script>

</head>

<body style="background: #eeeeee;">

  <div class="z-0">
    <!-- Navbar -->
    <div class="container-fluid" style="margin-bottom: 20px;">
      <!-- Navbar -->
      <nav class="navbar row">
        <div class="container-fluid">
          <a href="index.php">
            <img src="images/misc/scritta_bloonci_bianca.png" class="logo nav-brand">
          </a>
          <div class="search-container">
            <div class="search-box">
              <img src="images/misc/search.png" alt="Search Icon">
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
                <img src="images/misc/unkwownPhoto.jpeg" alt="User Photo">
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

            <?php
            $res = $cid->query("SELECT amministratore FROM utente WHERE email='$emailUtenteLoggato'");
            $row = $res->fetch_assoc();
            if ($row['amministratore'] == 1) {
              include "backEnd/stampaClassificaAmici.php";
            }
            ?>

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
                <div style="display: flex">
                  <img src="images/misc/unkwownPhoto.jpeg">
                  <div class="name-post">
                    <p><a href="frontEnd/bachecaPersonale.php">
                        <?php
                        $query = "SELECT nome, cognome FROM utente WHERE email='$emailUtenteLoggato'";
                        $result = $cid->query($query);
                        $row = $result->fetch_assoc();
                        echo $row['nome'] . " " . $row['cognome'];
                        ?>
                      </a></p>
                    <small>Public <i class=" fa-solid fa-earth-americas"></i></small>
                  </div>
                </div>
              </div>

              <?php
              $res = $cid->query("SELECT rispettabilità FROM utente WHERE email='$emailUtenteLoggato'");
              $row = $res->fetch_assoc();
              $rispettabilità = $row['rispettabilità'];

              if ($rispettabilità >= 2) {
                echo '<div class="post-input-container" id="postContainer">
                          <textarea rows="1" id="autoHeightTextarea" placeholder="Cos\'hai in mente?" oninput="autoResize()"></textarea>
                        </div>
                        <input type="file" id="imageFile" hidden>
                        <div id="message"></div>
                        <div class="post-footer">
                          <div>
                            <button class="request-button" id="pubblicaButton">pubblica</button>
                          </div>
                          <div>
                            <select id="postType" onchange="toggleFileInput()">
                              <option value="testo" selected>Testo</option>
                              <option value="foto">Foto</option>
                            </select>
                          </div>
                          <div style="display: flex">
                            <select id="province" class="form-select" name="province">
                              <option value=""></option>';
                include "backEnd/getProvinces.php";
                echo '</select>
                            <select id="birth_city" class="form-select" name="birth_city">';
                include "backEnd/getCities.php";
                echo '</select>
                          </div>
                        </div>';
              }
              ?>
            </div>

            <div class="post-container">
              <div class="user-profile">
                <div style="display: flex">
                  <img src="images/misc/unkwownPhoto.jpeg">
                  <div class="name-post">
                    <p><a href="#">Marco Abbiati</a></p>
                    <small>25 Luglio 2017, 13:45 - Pavia (PV)</small>
                  </div>
                </div>
                <div>
                  <button class=remove-btn>rimuovi</button>
                </div>
              </div>

              <p class="post-text">Ciao a tutti, come va oggi? pe</p>
              <img src="images/misc/feed-image-1.png" class="post-img">
              <div class="post-footer">
                <select class="rating-dropdown">
                  <option value="null">valuta</option>
                </select>
                <div>
                  <button class="open-comment-modal">commenta</button>
                </div>
                <div>
                  <button class="open-visualize-modal">guarda commenti</button>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal comment-modal">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Commenta questo post</h5>
                    </div>
                    <div class="modal-body">
                      <textarea class="comment-textarea" rows="4" cols="50" placeholder="Commenta..."></textarea>
                    </div>
                    <div class="modal-footer">
                      <button class="send-comment-btn" type="button" data-email="ale@ciao" data-timestamp="23:20">Invia
                        commento</button>
                      <button class="close-btn" type="button">chiudi</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal visualize-modal">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Commenta questo post</h5>
                    </div>
                    <div class="modal-body">
                      <div class="post-container">
                        <div class="user-profile">
                          <div class="name-post">
                            <p><a href="#">Marco Abbiati</a></p>
                          </div>
                        </div>
                        <p class="post-text">Ciao a tutti, come va oggi? per me molto bene
                          datoche l'Inter ha perso lol
                        </p>
                        <div class="post-footer">
                          <select class="rating-dropdown">
                            <option value="null">valuta</option>
                          </select>
                        </div>
                      </div>

                      <div class="post-container">
                        <div class="user-profile">
                          <div class="name-post">
                            <p><a href="#">Filippo Mele</a></p>
                          </div>
                        </div>
                        <p class="post-text">Sono bello</p>
                      </div>

                      <div class="post-container">
                        <div class="user-profile">
                          <div class="name-post">
                            <p><a href="#">Ciccio Caputo</a></p>
                          </div>
                        </div>
                        <p class="post-text">Oggi doppietta</p>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="close-btn" type="button">chiudi</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include "backEnd/allPosts.php" ?>
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
  </div>
  <footer class="container-fluid text-center p-3" style="background: transparent; color: #b9b9b9;">
    <p>&copy; 2023 Bloonci - All rights reserved</p>
  </footer>
</body>

</html>