<html>
    <head>
        <title> Registrazione nuovo cliente </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </head>
    <body>
        <p>Registrazione nuovo cliente</p>
        <form id = "form" action ="index.php?arg=nuovoUtente" method = "POST">
            <label>Username</label>
            <input type ="text" id="username" name="username" required="required"/><br>
            <label>Password</label>
            <input type ="password" id="password" name="password" required="required"/><br>
            <label>Ripeti password</label>
            <input type ="password" id="passwordR" name="passwordR" required="required" onChange="checkPasswords();"/><br>
            <button type="submit" id="conferma" name="conferma" disabled>Conferma</button>
        </form>
        <div id="avviso"></div>

        
    </body>    
</html>

<script>
    function checkPasswords() 
    {
        var passwordR = $("#passwordR").val();
        var password = $("#password").val();

        if (password != passwordR)
        {
            $("#avviso").html("Passwords don't match!");
            $("#conferma").prop( "disabled", true); 
        }
        else
        {
            $("#avviso").html("Passwords match.");
            $("#conferma").prop( "disabled", false); 
        }
    }

    $(document).ready(function () {
        $("#passwordR").keyup(checkPasswords);
    });
</script>
