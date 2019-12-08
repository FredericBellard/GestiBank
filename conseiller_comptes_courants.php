<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function getComptesCourants(){	
    	global $conn;
		$query = "SELECT id_compte, nom, prenom, date_creation, solde 
		FROM compte ct 
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
		WHERE type_compte=1 AND date_creation is not NULL";
		$response = array();
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_array($result))
		{
		$response[] = $row;
		//	echo $row[0];
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}

	// Orchestration des différentes fonctions
	switch($request_method)
	{
		case 'GET':
			// Récupérer les comptes courants
			if(!empty($_GET["id_compte"]))
			{
				$id_compte=intval($_GET["id_compte"]);
				getCompteCourant($id_compte);
			}
			else
			{
				getComptesCourants();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un compte-courant
			addCompteCourant();
			break;
			
		case 'PUT':
			// Modifier un compte courant
			$id_compte = intval($_GET["id_compte"]);
			updateCompteCourant($id_compte);
			break;
			
		case 'DELETE':
			// Supprimer un compte courant
			$id_compte = intval($_GET["id_compte"]);
			deleteCompteCourant($id_compte);
			break;
	}
?>
