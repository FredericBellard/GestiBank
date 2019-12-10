<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function getDetailsDemandes(){	
    	global $conn;
		$query = "SELECT ref_demande, date_demande, type_compte, nom, prenom, num_rue, nom_rue, code_postal, ville, telephone, statut, nb_enfants, type_document, contenu_document 
		FROM utilisateur u 
        INNER JOIN adresse a ON u.id_user=a.id_user
		INNER JOIN client c ON u.id_user=c.id_user 
		INNER JOIN demande_client ON c.id_client=demande_client.id_client 
		INNER JOIN compte ON c.id_client=compte.id_client 
        INNER JOIN document ON c.id_client=document.id_client
		WHERE (type_user='0' AND type_demande='0' AND date_creation is NULL)";
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

	function getDetailsDemande($ref_demande){
    	global $conn;
		$query = 'SELECT ref_demande, date_demande, type_compte, nom, prenom, num_rue, nom_rue, code_postal, ville, telephone, statut, nb_enfants, type_document, contenu_document 
		FROM utilisateur u 
        INNER JOIN adresse a ON u.id_user=a.id_user
		INNER JOIN client c ON u.id_user=c.id_user 
		INNER JOIN demande_client ON c.id_client=demande_client.id_client 
		INNER JOIN compte ON c.id_client=compte.id_client 
        INNER JOIN document ON c.id_client=document.id_client
		WHERE (type_user="0" AND type_demande="0" AND date_creation is NULL) AND ref_demande="'.$ref_demande.'"';
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

		if(!empty($_GET["ref_demande"]))
			{
				$ref_demande=intval($_GET["ref_demande"]);
				getDetailsDemande($ref_demande);
			}
			else
			{
			getDetailsDemandes();
			}
?>