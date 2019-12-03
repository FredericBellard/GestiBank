<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    $db_host     = 'localhost';
    $db_name     = 'gk-force';
    $db_username = 'root';
    $db_password = '';
    

    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    

    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateur where 
              nom = '".$username."' and password = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0)
        {
           $_SESSION['nom'] = $username;
           header('Location: bienvenue.php');
        }
        else
        {
           header('Location: authentification.php');
        }

	}
	else
	{
		header('Location: authentification.php');
	}
	mysqli_close($db); 
}
?>