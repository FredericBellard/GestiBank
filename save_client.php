<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sauvegarde</title>
    <link rel="stylesheet" href="styles.css">
</head> 
<?php
$pseudonyme = $_POST["pseudonyme"];
$password = $_POST["password"];
include("db_connect.php"); 

$query="UPDATE client SET id_conseiller='".$id_conseiller."' WHERE id_client=".$id_client;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Administrateur mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de l_. '. mysqli_error($conn)
			);
		}




?>
<form action='affect.php'>
    <button>Retour</button>
</form>