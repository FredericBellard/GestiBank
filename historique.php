<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: DELETE");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getHistoriques()
	{
		global $conn;
		$query = "SELECT * FROM historique";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getHistorique($id_histo=0)
	{
		global $conn;
		$query = "SELECT * FROM historique";
		if($id_histo != 0)
		{
			$query .= " WHERE id_histo=".$id_histo." LIMIT 1";
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
	
	function AddHistorique()
	{
		global $conn;
		
		// GET DATA FROM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$date_operation = $data->date_operation;
		$nature_operation = $data->nature_operation;
		$debit = $data->debit;
		$credit = $data->credit;
		$num_compte = $data->num_compte;
		$num_transaction = $data->num_transaction;
		
		echo $query="INSERT INTO historique(date_operation, nature_operation, debit, credit, num_compte, num_transaction) VALUES('".$date_operation."', '".$nature_operation."', '".$debit."', '".$credit."', '".$num_compte."', '".$num_transaction."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Elément ajouté avec succès.'
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
	
	function updateHistorique($id_histo)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$date_operation = $data["date_operation"];
		$nature_operation = $data["nature_operation"];
		$debit = $data["debit"];
		$credit = $data["credit"];
		$num_compte = $data["num_compte"];
		$num_transaction = $data["num_transaction"];
		$query="UPDATE historique SET date_operation='".$date_operation."', nature_operation='".$nature_operation."', debit='".$debit."', credit='".$credit."', num_compte='".$num_compte."', num_transaction='".$num_transaction."' WHERE id_histo=".$id_histo;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Historique mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de l_historique. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteHistorique($id_histo)
	{
		global $conn;
		$query = "DELETE FROM historique WHERE id_histo=".$id_histo;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Elément supprimé avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression de l_élément a échoué. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	// Orchestration des différentes fonctions
	switch($request_method)
	{
		
		case 'GET':
			// Récupérer un ou plusieurs éléments dans l'historique
			if(!empty($_GET["id_histo"]))
			{
				$id_histo=intval($_GET["id_histo"]);
				getHistorique($id_histo);
			}
			else
			{
				getHistoriques();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un élément
			AddHistorique();
			break;
			
		case 'PUT':
			// Modifier un élément
			$id_histo = intval($_GET["id_histo"]);
			updateHistorique($id_histo);
			break;
			
		case 'DELETE':
			// Supprimer un élément
			$id_histo = intval($_GET["id_histo"]);
			deleteHistorique($id_histo);
			break;

	}
?>