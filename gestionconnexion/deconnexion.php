<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body style='background:#fff;'>
        <div id="content">
            
           <!-- <a href='bienvenue.php?deconnexion=true'><span>Déconnexion</span></a>-->

            <?php
                session_start();
              /*  if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  */
              if(isset($_SESSION['deconnexion']))
                { 
                   if($_SESSION['deconnexion']==true)
                   {                      
                      session_unset();
                      header("location:authentification.php");
                   }
                }
                else if($_SESSION['nom'] !== "")
                {
                    $user = $_SESSION['nom'];
                    echo "<br>Bonjour $user, vous êtes connectés";
                   // header("location:authentification.php");
                }
            ?>              
            </form>
            
        </div>
    </body>
</html>