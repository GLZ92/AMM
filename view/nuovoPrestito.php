<?php
    echo "<p>Nuovo prestito</p>";
    echo "<div class='error'></div>";
    echo "<form action ='index.php?arg=nuovoPrestito2' method ='POST'>
            <label>Nome utente</label>
            <select name='user'>";
                while (($row = $utenti->fetch_row()) != null)
                     echo "<option value = '{$row[0]}'>$row[0]</option>";
            
    echo    "</select>
            <br>
            <label>Titolo libro</label>
            <select name='libro'>";
                while (($row = $libri->fetch_row()) != null)
                    echo "<option value = '{$row[1]}'>$row[0]</option>";
    echo    "</select>
            <br>
            <input type='submit' value='Conferma'>";
?>