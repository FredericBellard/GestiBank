<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: DELETE");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getClients()
	{
		global $conn;
		$query = "SELECT * FROM client";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getClient($id_client)
	{
		global $conn;
		$query = "SELECT * FROM client";
		if($id_client != 0)
		{
	        $query .= " WHERE id_client=".$id_client." LIMIT 1";
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


	function AddClient()
	{
		global $conn;
		/*$name = $_POST["name"];
		$description = $_POST["description"];
		$price = $_POST["price"];
		$category = $_POST["category"];
		$created = date('Y-m-d H:i:s');
		$modified = date('Y-m-d H:i:s');*/

		// GET DATA FORM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$id_user = $data->id_user;
		$adresse = $data->adresse;
		$id_document = $data->id_document;
		$telephone = $data->telephone;
		$num_enfants = $data->num_enfants;
		$sit_matrimon = $data->sit_matrimon;
		$id_client=-1;
		
		
		echo $query="INSERT INTO client (id_user,adresse, id_document,telephone, num_enfants, sit_matrimon) VALUES('".$id_user."', '".$adresse."', '".$id_document."', '".$telephone."', '".$num_enfants."', '".$sit_matrimon."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'client ajouté avec succès.'
			);
			$id_client=$conn->insert_id;
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
	
	function updateClient($id_client)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$id_conseiller= $data["id_conseiller"];
		$id_user = $data["id_user"];
		$adresse = $data["adresse"];
		$id_document = $data["id_document"];
		$telephone = $data["telephone"];
		$num_enfants = $data["num_enfants"];
		$sit_matrimon = $data["sit_matrimon"];
		$query="UPDATE client SET id_user ='".$id_user."',adresse='".$adresse."', id_document='".id_document."', telephone ='".$telephone."', num_enfants='".$num_enfants."', sit_matrimon='".$sit_matrimon."' WHERE id_client=".$id_client;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'client mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de l_client. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteClient($id_client)
	{
		global $conn;
		$query = "DELETE FROM client WHERE id_client=".$id_client;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'client supprimé avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression de l_client a échoué. '. mysqli_error($conn)
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
			if(!empty($_GET["id_client"]))
			{
				$id_user=intval($_GET["id_client"]);
				getClient($id_client);
			}
			else
			{
				getClients();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un produit
			AddClient();
			break;
			
		case 'PUT':
			// Modifier un produit
			$id_client = intval($_GET["id_client"]);
			updateClient($id_client);
			break;
			
		case 'DELETE':
			// Supprimer un produit
			$id_client = intval($_GET["id_client"]);
			deleteClient($id_client);
			break;

	}
?>