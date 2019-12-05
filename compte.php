<?php
	header("charset:utf8");
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getComptes()
	{   
		global $conn;
		$query = "SELECT * FROM compte";
		$response = array();
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
			
		}
		header('Content-Type: application/json');
	    echo json_encode($response, JSON_PRETTY_PRINT);
		
		
	}
	
	function getCompte($id_compte)
	{
		global $conn;
		$query = "SELECT * FROM compte";
		if($num_compte != 0)
		{
			$query .= " WHERE id_compte=".$id_compte." LIMIT 1";
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
	
	function AddCompte()
	{
		global $conn;

		// GET DATA FORM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$id_compte=$data->id_compte;
		$rib = $data->rib;
		$date_creation = $data->date_creation;
		$solde = $data->solde;
		$type_compte =$data->type_compte;
		$id_client = $data->id_client;
		
		echo $query="INSERT INTO compte(id_compte,rib,date_creation,solde,type_compte,id_client)
		VALUES('".$id_compte."','".$rib."','".$date_creation."', '".$solde."',,'".	$type_compte."' '".$id_client."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Compte ajouté avec succès.'
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
		print_r($response);
	}

	function updateCompte($id_compte)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$rib = $data["rib"];
		$date_creation = $data["date_creation"];
		$solde = $data["solde"];
		$type_compte =$data["type_compte"];
		$id_client = $data["id_client"];

		$query="UPDATE compte SET rib='".$rib."',date_creation='".$date_creation."', solde=".$solde.",type_compte='".$type_compte."', id_client=".$id_client. " WHERE id_compte=".$id_compte;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Compte mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour du compte. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteCompte($id_compte)
	{
		global $conn;
		$query = "DELETE FROM compte WHERE id_compte=".$id_compte;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Compte supprimé avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression du compte a échoué. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	// Orchestration des différentes fonctions
	switch($request_method)
	{
		
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id_compte"]))
			{
				$id_compte=intval($_GET["id_compte"]);
				getCompte($id_compte);
			}
			else
			{
				getComptes();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un compte
			AddCompte();
			break;
			
		case 'PUT':
			// Modifier un compte
			$id_compte = intval($_GET["id_compte"]);
			updateCompte($num_compte);
			break;
			
		case 'DELETE':
			// Supprimer un compte
			$id_compte = intval($_GET["id_compte"]);
			deleteCompte($id_compte);
			break;

	}
?>