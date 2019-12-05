<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: DELETE");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getNotifications()
	{
		global $conn;
		$query = "SELECT * FROM notification";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getNotification($ref_notif)
	{
		global $conn;
		$query = "SELECT * FROM notification";
		if($ref_notif != 0)
		{
			$query .= " WHERE ref_notif=".$ref_notif." LIMIT 1";
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
	
	function AddNotification()
	{
		global $conn;
		
		// GET DATA FROM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$date_notif = $data->date_notif;
		$message_notif = $data->message_notif;
		$num_transaction = $data->num_transaction;
		$num_compte = $data->num_compte;
		$ref_demande = $data->ref_demande;
		$ref_demande_ouverture = $data->ref_demande_ouverture;
				
		echo $query="INSERT INTO notification(date_notif, message_notif, num_transaction, num_compte, ref_demande, ref_demande_ouverture) VALUES('".$date_notif."', '".$message_notif."', '".$num_transaction."', '".$num_compte."', '".$ref_demande."', '".$ref_demande_ouverture."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Notification ajoutée avec succès.'
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
	
	function updateNotification($ref_notif)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$date_notif = $data["date_notif"];
		$message_notif = $data["message_notif"];
		$num_transaction = $data["num_transaction"];
		$num_compte = $data["num_compte"];
		$ref_demande = $data["ref_demande"];
		$ref_demande_ouverture = $data["ref_demande_ouverture"];
		$query="UPDATE notification SET date_notif='".$date_notif."', message_notif='".$message_notif."', num_transaction='".$num_transaction."', num_compte='".$num_compte."', ref_demande='".$ref_demande."', ref_demande_ouverture='".$ref_demande_ouverture."' WHERE ref_notif=".$ref_notif;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Notification mise à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de la notification. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteNotification($ref_notif)
	{
		global $conn;
		$query = "DELETE FROM notification WHERE ref_notif=".$ref_notif;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Notification supprimée avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression de la notification a échoué. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	// Orchestration des différentes fonctions
	switch($request_method)
	{
		
		case 'GET':
			// Récupérer un ou plusieurs utilisateurs
			if(!empty($_GET["ref_notif"]))
			{
				$ref_notif=intval($_GET["ref_notif"]);
				getNotification($ref_notif);
			}
			else
			{
				getNotifications();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter une notification
			AddNotification();
			break;
			
		case 'PUT':
			// Modifier une notification
			$ref_notif = intval($_GET["ref_notif"]);
			updateNotification($ref_notif);
			break;
			
		case 'DELETE':
			// Supprimer une notification
			$ref_notif = intval($_GET["ref_notif"]);
			deleteNotification($ref_notif);
			break;

	}
?>