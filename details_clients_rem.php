<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function getDetailsClientsRem(){	
    	global $conn;
		$query = "SELECT numero_compte, date_creation, nom, prenom, num_rue, nom_rue, code_postal, ville, telephone, statut, nb_enfants, taux_interet, facilite_caisse, montant_debit, solde 
		FROM compte ct 
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
        INNER JOIN adresse a ON a.id_user=u.id_user
        INNER JOIN compte_rem cr ON ct.id_compte=cr.id_compte
		WHERE type_compte=0 AND date_creation is not NULL";
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

	function getDetailsClientRem($id_compte_rem){	
    	global $conn;
		$query = 'SELECT numero_compte, date_creation, nom, prenom, num_rue, nom_rue, code_postal, ville, telephone, statut, nb_enfants, taux_interet, facilite_caisse, montant_debit, solde 
		FROM compte ct 
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
        INNER JOIN adresse a ON a.id_user=u.id_user
        INNER JOIN compte_rem cr ON ct.id_compte=cr.id_compte
		WHERE type_compte=0 AND (date_creation is not NULL) AND id_compte_rem="'.$id_compte_rem.'"';
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

	if(!empty($_GET["id_compte_rem"]))
			{
				$id_compte_rem=intval($_GET["id_compte_rem"]);
				getDetailsClientRem($id_compte_rem);
			}
			else
			{
				getDetailsClientsRem();
			}

?>
