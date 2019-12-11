<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	//echo "Request Method".$request_method;
	
	function getDemandes(){	
    	global $conn;
		$query = "SELECT *
			FROM demande_client
			INNER JOIN client ON client.id_client = demande_client.id_client
			INNER JOIN utilisateur ON client.id_user = utilisateur.id_user
			where client.id_conseiller=-1 or utilisateur.pseudo in('', null) 
								or utilisateur.mot_de_passe in('', null) and type_demande=0";
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


	function update(){
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$id_client = $data["id_client"];
		$id_conseiller = $data["id_conseiller"];
		
		$query="UPDATE client SET id_conseiller=".$id_conseiller." WHERE id_client=".$id_client;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Demande mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de l_. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
		// Orchestration des différentes fonctions
		switch($request_method)
		{
			case "GET":
				// Récupérer les comptes rémunérés
				if(!empty($_GET["id_demande"]))
				{
					getDemandes();
				}
				else
				{
					getDemandes();
				}
				break;
	
			case 'POST':
				getDemandes();
				break;
				
			case 'PUT':
				// Modifier un compte rémunéré
				update();
				break;
				
			case 'DELETE':
				// Supprimer un compte rémunéré
				break;
			default:
				// Invalid Request Method
				header("HTTP/1.0 405 Method Not Allowed");
				break;
		}
	
?>