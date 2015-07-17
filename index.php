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
                    $controller->content($value);
                ?>
            </div>
            <div id="sidebar">			
                <?php 
                    $controller->sidebar();
                ?>
            </div>
            <div id="clear"></div>
            <div id="footer"></div>
        </div>
    </body>
</html>

