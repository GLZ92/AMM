<?
    echo "<p>Registrazione nuovo autore</p>";
    echo "<form id = 'form' action ='index.php?arg=nuovoAutore2' method = 'POST'>
            <label>Nome</label>
            <input type ='text' id='nome' name='nome' required='required'/><br>
            <label>Cognome</label>
            <input type ='cognome' id='cognome' name='cognome' required='required'/><br>
            <button type='submit' id='conferma' name='conferma'>Conferma</button>
        </form>";
 ?>