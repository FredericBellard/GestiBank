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
        $taux_interet = $data["taux_interet"];
        $facilite_caisse = $data["facilite_caisse"];
        $montant_debit = $data["montant_debit"];
        $solde = $data["solde"];
        $query="UPDATE compte c
		INNER JOIN demande_client dc ON c.id_client=dc.id_client 
		SET numero_compte ='".$numero_compte."',date_creation='".$date_creation."', solde='".$solde."'
		WHERE ref_demande='".$ref_demande."'";
		$response = array();
        $result = mysqli_query($conn, $query);
        
        $query="SELECT id_compte FROM compte c
            INNER JOIN demande_client dc ON c.id_client=dc.id_client
            WHERE ref_demande='".$ref_demande."'";
            $result = (mysqli_query($conn, $query));
            while($row = mysqli_fetch_array($result)){
            $id_compte=$row['id_compte'];
            }
        
        $query="INSERT INTO compte_rem(taux_interet,id_compte,facilite_caisse,montant_debit) VALUES('".$taux_interet."', '".$id_compte."', '".$facilite_caisse."', '".$montant_debit."')";	
		if(mysqli_query($conn, $query))
		{
            $response=array
            (
            'status' => 1,
            'status_message' =>'Votre demande a bien été prise en compte.'
            );
            }
            else
			{
			    $response=array
			    (
				'status' => 0,
				'status_message' =>'ERREUR!.'. mysqli_error($conn)
				);
				echo $query;
			}
        
            header('Content-Type: application/json');
		echo json_encode($response);
    }

	function refuseDemande($ref_demande){
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
			refuseDemande($ref_demande);
			break;
	}
?>