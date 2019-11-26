<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: DELETE");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getTransactions()
	{
		global $conn;
		$query = "SELECT * FROM transaction";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getTransaction($num_transaction=0)
	{
		global $conn;
		$query = "SELECT * FROM transaction";
		if($num_transaction != 0)
		{
			$query .= " WHERE num_transaction=".$num_transaction." LIMIT 1";
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
	
	function AddTransaction()
	{
		global $conn;
		/*$name = $_POST["name"];
		$description = $_POST["description"];
		$price = $_POST["price"];
		$category = $_POST["category"];
		$created = date('Y-m-d H:i:s');
		$modified = date('Y-m-d H:i:s');*/

		// GET DATA FROM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$date_transaction = date('Y-m-d H:i:s');
		$type_transaction = $data->type_transaction;
		$montant_transaction = $data->montant_transaction;
		$id_client = $data->id_client;
				
		echo $query="INSERT INTO transaction (date_transaction, type_transaction, montant_transaction, id_client) VALUES('".$date_transaction."', '".$type_transaction."', '".$montant_transaction."', '".$id_client."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Transaction ajoutée avec succès.'
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
	
	function updateTransaction($num_transaction)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$date_transaction = $data["date_transaction"];
		$type_transaction = $data["type_transaction"];
		$montant_transaction = $data["montant_transaction"];
		$id_client = $data["id_client"];
		$query="UPDATE transaction SET date_transaction='".$date_transaction."', type_transaction='".$type_transaction."', montant_transaction='".$montant_transaction."', id_client='".$id_client."' WHERE num_transaction=".$num_transaction;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Transaction mise à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de la transaction. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteTransaction($num_transaction)
	{
		global $conn;
		$query = "DELETE FROM transaction WHERE num_transaction=".$num_transaction;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Transaction supprimée avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression de la transaction a échoué. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	// Orchestration des différentes fonctions
	switch($request_method)
	{
		
		case 'GET':
			if(!empty($_GET["num_transaction"]))
			{
				$num_transaction=intval($_GET["num_transaction"]);
				getTransaction($num_transaction);
			}
			else
			{
				getTransactions();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter une transaction
			AddTransaction();
			break;
			
		case 'PUT':
			// Modifier une transaction
			$num_transaction = intval($_GET["num_transaction"]);
			updateTransaction($num_transaction);
			break;
			
		case 'DELETE':
			// Supprimer une transaction
			$num_transaction = intval($_GET["num_transaction"]);
			deleteTransaction($num_transaction);
			break;

	}
?>