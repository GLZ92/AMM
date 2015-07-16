<?php
 echo  "<p>Registrazione nuovo cliente</p>
        <form id = 'form' action ='index.php?arg=nuovoUtente' method = 'POST'>
            <label>Nome</label>
            <input type ='text' id='username' name='username' required='required'/><br>
            <label>Password</label>
            <input type ='password' id='password' name='password' required='required'/><br>
            <label>Ripeti password</label>
            <input type ='password' id='passwordR' name='passwordR' required='required'/><br>
            <button type='submit' id='conferma' name='conferma' disabled>Conferma</button>
        </form>
		<div id='avviso'></div>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
$("#passwordR").keyup(function()
{
	var passwordR = $("#passwordR").val();
    var password = $("#password").val();
    if (password != passwordR)
    {
	    $.get("view/nomatch.html", function(data)
        {
	        $("#avviso").html(data);
        })
        $("#conferma").prop( "disabled", true);
    }
    else if(password != "" && passwordR != "")
	{
		$.get("view/match.html", function(data)
        {
        	$("#avviso").html(data);
        })
        $("#conferma").prop( "disabled", false);
	}
	else
		$("#avviso").html("");
});
$("#password").keyup(function()
{
	var passwordR = $("#passwordR").val();
    var password = $("#password").val();
	
    if (password != passwordR)
    {
	    $.get("view/nomatch.html", function(data)
        {
	        $("#avviso").html(data);
        })
        $("#conferma").prop( "disabled", true);
    }
    else if(password != "" && passwordR != "")
	{
		$.get("view/match.html", function(data)
        {
        	$("#avviso").html(data);
        })
        $("#conferma").prop( "disabled", false);
	}
	else
            $("#avviso").html("");
});
</script>

