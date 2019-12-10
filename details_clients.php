<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function getDetailsClients(){	
    	global $conn;
		$query = "SELECT numero_compte, date_creation, nom, prenom, num_rue, nom_rue, code_postal, ville, telephone, statut, nb_enfants, solde 
		FROM compte ct 
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
        INNER JOIN adresse a ON a.id_user=u.id_user
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

	function getDetailsClient($id_compte){	
    	global $conn;
		$query = 'SELECT numero_compte, date_creation, nom, prenom, num_rue, nom_rue, code_postal, ville, telephone, statut, nb_enfants, solde 
		FROM compte ct 
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
        INNER JOIN adresse a ON a.id_user=u.id_user
		WHERE type_compte=1 AND (date_creation is not NULL) AND id_compte="'.$id_compte.'"';
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

	if(!empty($_GET["id_compte"]))
			{
				$id_compte=intval($_GET["id_compte"]);
				getDetailsClient($id_compte);
			}
			else
			{
				getDetailsClients();
			}

?>
