<?php
    $user = $_SESSION['username'];
    echo "Benvenuto $user!";


    echo "<h4>Ora puoi tranquillamente navigare nel nostro sito. A tua disposizione hai una barra di navigazione laterale a destra
        tramite la quale potrai scoprire l'elenco dei libri in nostro possesso oppure verificare lo stato dei tuoi prestiti</h4>
    <h2>Se invece vuoi effettuare il logout premi il bottone sottostante</h2>";

    echo "<form action='index.php?arg=logout' method='POST'>
        <button type='Logout' name='logout'>Logout</button> 
    </form>";
?>
