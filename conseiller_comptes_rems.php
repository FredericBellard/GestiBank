<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function getComptesRems(){	
    	global $conn;
		$query = "SELECT id_compte_rem, numero_compte, nom, prenom, date_creation, taux_interet, facilite_caisse, montant_debit, solde 
		FROM compte ct 
        INNER JOIN compte_rem cr ON ct.id_compte=cr.id_compte
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
		WHERE type_compte=0";
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

	getComptesRems();
	
?>