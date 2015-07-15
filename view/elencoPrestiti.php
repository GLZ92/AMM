<?php
    echo "LIBRI IN PRESTITO: ";
    echo "<table align='center'>";
    echo "<tr><th>Titolo</th><th>Autore</th><th>Prestato a</th></tr>";
    $libri = array();
    while($row = $result->fetch_row())
    {
        $libri[] = $row[0];
        echo "<tr> <td>$row[0]</td> <td>$row[1] $row[2]</td> <td>$row[3]</td></tr>";
    }
    echo "</table>";

    if(count($libri) > 0)
    {
        echo "<br><br>Selezionare prestito da cancellare<br>";
        echo "<form action ='index.php?arg=cancellaPrestito' method='POST'>";
        echo "<select name = 'libro'>";
        foreach ($libri as $item)
            echo "<option value='$item'>$item</option>";
        echo "</select><br>";
        echo "<input type='submit' id='conferma' name='conferma' value='cancella prestito'/>";
        echo "</form>";
    }
?>

