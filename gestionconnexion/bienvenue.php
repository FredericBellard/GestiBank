<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body style='background:#fff;'>
        <div id="content">
            <?php
                session_start();
                if($_SESSION['nom'] !== ""){
                    $user = $_SESSION['nom'];
                    echo "Bonjour $user, vous êtes connecté.";
                }
                $_SESSION['deconnexion'] = ($_SESSION['nom'] !== "");
              //  echo $_SESSION['deconnexion'];
            ?>

          <form action="deconnexion.php" method="POST"> 
            <input type="submit" id='submit' value='deconnexion' >
            </form>
            
        </div>
    </body>
</html>