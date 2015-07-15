<!DOCTYPE html>
<html>
    <head>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="css/style.css" type="text/css"> 
        <script type="text/javascript" src="time.js"></script>
        <title>Home page</title>
    </head>
    <body>
        <div id="page">
            <div id="header"></div>
			<div id="time"></div><script type="text/javascript">window.onload = time();</script>
            <div id="content">
                <?php
                    if (isset($_REQUEST['arg'])) 
                        $value = $_REQUEST['arg'];
                    else
                        $value ="";
                    include_once("controller/Controller.php");

                    $controller = new Controller();
                    $controller->invoke($value);
                ?>
            </div>
            <div id="sidebar">			
                <?php 
                    if(isset($_SESSION["loggedIn"]))
                    {
                        if($_SESSION["loggedIn"] == false)
                            echo '<div id="tab"><a href= "index.php?arg=loginAttempt">Login</a></div>';
                        else
                        {
                            $user = $_SESSION['username'];
                            echo '<div id="tab"><a href= "index.php?arg=logout">';
                            echo $user;
                            echo " / logout";
                            echo '</a></div>';
                        }
                    }
                    else
                        echo '<div id="tab"><a href= "index.php?arg=loginAttempt">Login</a></div>';

                ?>
                <div id ="tab"><a href ="index.php?arg=iscriviti">Iscriviti</div>
                <div id ="tab"><a href ="index.php?arg=nuovoPrestito">Prestito libro</a></div>
                <div id="tab"><a href= "index.php?arg=prestiti">Prestiti</a></div>
                <div id="tab"><a href= "index.php?arg=libri">Libri</a></div>
            </div>

            <div id="clear"></div>
            <div id="footer"></div>
        </div>
    </body>
</html>

