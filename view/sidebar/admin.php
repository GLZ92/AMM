<?php
    $user = $_SESSION['username'];
    echo '<div id="tab"><a href= "index.php?arg=logout">';
    echo $user;
    echo " / logout";
    echo '</a></div>';
    echo "<div id ='tab'><a href ='index.php?arg=nuovoPrestito'>Prestito libro</a></div>";
    echo "<div id='tab'><a href= 'index.php?arg=prestiti'>Elenco prestiti</a></div>";
    echo "<div id='tab'><a href= 'index.php?arg=libri'>Elenco libri</a></div>";
    echo "<div id='tab'><a href= 'index.php?arg=nuovoAutore'>Aggiungi autore</a></div>";
?>