<?php
try {
    $emailUtenteLoggato = $_SESSION['email'];
    $sql = "SELECT nome, cognome, dataNascita, cittàNacita, provinciaNascita, orientamentoSessuale, rispettabilità
    FROM utente WHERE email = '$emailUtenteLoggato';";
    $result = $cid->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='user-info'>";
            echo "<div class='info-list'><div>Nome: </div><span><button id='openModalBtnNome'>" . ($row['nome'] ?? "<div class='non-disponibile'>non disponibile</div>") . "</button></span></div>";
            echo "<div class='info-list'><div>Cognome: </div><span><button id='openModalBtnCognome'>" . ($row['cognome'] ?? "<div class='non-disponibile'>non disponibile</div>") . "</button></span></div>";
            echo "<div class='info-list'><div>Data di nascita: </div><span>" . ($row['dataNascita'] ? date('d-m-Y', strtotime($row['dataNascita'])) : "<div class='non-disponibile'>non disponibile</div>") . "</span></div>";
            echo "<div class='info-list'><div>Luogo di nascita: </div><span>" . ($row['cittàNacita'] ?? "<div class='non-disponibile'>non disponibile</div>") . "</span></div>";
            echo "<div class='info-list'><div>in provincia di: </div><span>" . ($row['provinciaNascita'] ?? "<div class='non-disponibile'>non disponibile</div>") . "</span></div>";
            echo "<div class='info-list'><div>Orientamento sessuale: </div><span>" . ($row['orientamentoSessuale'] ?? "<div class='non-disponibile'>non disponibile</div>") . "</span></div>";
            echo "<div class='info-list'><div>Rispettabilità: </div><span>" . ($row['rispettabilità'] ?? "<div class='non-disponibile'>non disponibile</div>") . "</span></div>";
            echo "</div>";
        }
    } else {
        echo "Non ci sono risultati per questa query.";
    }
} catch (Exception $error) {
    echo $error;
}
?>