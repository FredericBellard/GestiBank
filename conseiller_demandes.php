<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function getDemandes(){	
    	global $conn;
		$query = "SELECT ref_demande, date_demande, u.id_user, nom, prenom, type_compte 
		FROM utilisateur u 
		INNER JOIN client c ON u.id_user=c.id_user 
		INNER JOIN demande_client ON c.id_client=demande_client.id_client 
		INNER JOIN compte ON c.id_client=compte.id_client 
		WHERE (type_user='0' AND type_demande='0')";
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

	getDemandes();
	
?>