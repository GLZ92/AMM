<!DOCTYPE html>
<html>
    <head>
	<meta http-equip="Content-Type" content="text/html; charset=utf-8">	
	<title>Elenco libri</title>
    </head>
    <body>
        <?php
            echo "<form action ='index.php?arg=cancellaLibro' method='POST'>";
            echo "ELENCO LIBRI: ";
            echo "<table align='center'>";
            echo "<tr><th>Titolo</th><th>Autore</th></tr>";
            while($row = $libri->fetch_row())
		echo "<tr> <td>$row[0]</td> <td>$row[1] $row[2]</td> <td><input type='submit' id='cancella$row[3]' name='cancella$row[3]' value='Cancella'/></tr>";
            echo "</table><br><br>";
            echo "</form>";
            
            echo "<p>Registra nuovo libro</p>";
            echo "<form action='index.php?arg=nuovoLibro' method='POST'>
                    <label>Titolo</label>
                    <input type ='text' name ='titolo' id='titolo' required/><br>
                    <label>Autore</label>
                    <select name ='autore'>";
                    while($row = $autori->fetch_row())
		echo "<option value ='$row[2]'> $row[0] $row[1]</option>";
                echo "</select>
                    <input type='submit' id='conferma' name='conferma' value='Aggiungi libro'/><br><br><br>";
	?>
    </body>
</html>
