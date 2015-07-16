<!DOCTYPE html>
<html>
    <head>
	<meta http-equip="Content-Type" content="text/html; charset=utf-8">	
	<title>Elenco libri</title>
    </head>
    <body>
        <?php
            echo "ELENCO LIBRI: ";
            echo "<table align='center'>";
            echo "<tr><th>Titolo</th><th>Autore</th></tr>";
            while($row = $libri->fetch_row())
		echo "<tr> <td>$row[0]</td> <td>$row[1] $row[2]</td> </tr>";
            echo "</table>";
	?>
    </body>
</html>
