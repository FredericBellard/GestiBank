<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function acceptDemande($ref_demande){
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$numero_compte= $data["numero_compte"];
		$date_creation = $data["date_creation"];
		$solde = $data["solde"];
		$query="UPDATE compte c
		INNER JOIN demande_client dc ON c.id_client=dc.id_client 
		SET numero_compte ='".$numero_compte."',date_creation='".$date_creation."', solde='".$solde."'
		WHERE ref_demande='".$ref_demande."'";
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

	function refusDemande($ref_demande){
        global $conn;
        $data = json_decode(file_get_contents("php://input"),true);
		$query = "DELETE FROM demande_client WHERE ref_demande='".$ref_demande."'";
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
		case 'PUT':
			$ref_demande = intval($_GET["ref_demande"]);
			acceptDemande($ref_demande);
			break;

		case 'DELETE':
			$ref_demande = intval($_GET["ref_demande"]);
			refusDemande($ref_demande);
			break;
	}
?>