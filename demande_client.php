<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

   //get All Demande_Client
	function getDemandeClients()
	{
		global $conn;
		$query = "SELECT * FROM demande_client";
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

	// Récupérer une demande par la référence de la demande
	function getDemandeClient($ref_demande=0)
	{
		global $conn;
		$query = "SELECT * FROM demande_client";
		if($ref_demande != 0)
		{
			$query .= " WHERE ref_demande=".$ref_demande." LIMIT 1";
		}
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}

	//Ajouter un élément dans la table demande_client
	function AddDemandeClients()
	{
		global $conn;
		
		// GET DATA FORM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$date_demande = $data->date_demande;
		$type_demande = $data->type_demande;
		$id_client = $data->id_client;
		
		
		echo $query="INSERT INTO demande_client(date_demande,type_demande, id_client) VALUES('".$date_demande."', '".$type_demande."', '".$id_client."')";
		if(mysqli_query($conn, $query))
		{
		$response=array(
		'status' => 1,
		'status_message' =>'Votre demande a bien été prise en compte.'
		);
		}
		else
		{
		$response=array(
		'status' => 0,
		'status_message' =>'ERREUR!.'. mysqli_error($conn)
		);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	//mettre à jour un élement dans la table demande_client
	function updateDemandeClients($ref_demande)
	{
		global $conn;
        $data = json_decode(file_get_contents("php://input"),true);

		$date_demande = $data["date_demande"];
		$type_demande = $data["type_demande"];
		$id_client = $data["id_client"];

		$query="UPDATE demande_client SET date_demande='".$date_demande."', type_demande='".$type_demande."', id_client='".$id_client."' WHERE ref_demande=".$ref_demande;
		if(mysqli_query($conn, $query))
		{
		$response=array(
		'status' => 1,
		'status_message' =>'Votre demande a bien été mise à jour avec succès.'
		);
		}
		else
		{
		$response=array(
		'status' => 0,
		'status_message' =>'échec de la mise à jour de votre demande. '. mysqli_error($conn)
		);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// Supprimer un élément
	function deleteDemandeClients($ref_demande)
	{
		global $conn;
		$query = "DELETE FROM demande_client WHERE ref_demande=".$ref_demande;
		if(mysqli_query($conn, $query))
		{
		$response=array(
		'status' => 1,
		'status_message' =>'Demande supprimé avec succès.'
		);
		}
		else
		{
		$response=array(
		'status' => 0,
		'status_message' =>'La suppression de votre demande a échoué. '. mysqli_error($conn)
		);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	// Orchestration des différentes fonctions
	switch($request_method)
	{
		
		case 'GET':
		if(!empty($_GET["ref_demande"]))
		{
		$ref_demande=intval($_GET["ref_demande"]);
		getDemandeClient($ref_demande);
		}
		else
		{
		getDemandeClients();
		}
		break;
		default:
		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed");
		break;
		
		case 'POST':
		// Ajouter une demande 
		AddDemandeClients();
		break;
		
		case 'PUT':
		// Modifier une demande
		$ref_demande= intval($_GET["ref_demande"]);
		updateDemandeClients($ref_demande);
		break;
		
		case 'DELETE':
		// Supprimer une demande
		$ref_demande= intval($_GET["ref_demande"]);
		deleteDemandeClients($ref_demande);
		break;

	}
?>