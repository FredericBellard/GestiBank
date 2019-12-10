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

		
		`id_transaction`, `date_transaction`, `type_transaction`, `montant_transaction`, `id_compte`
	function AddTransaction()
	{
		global $conn;

		// GET DATA FORM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$id_transaction=$data->id_transaction;
		$date_transaction = $data->date_transaction;
		$type_transaction = $data->type_transaction;
		$montant_transaction = $data->montant_transaction;
		$id_compte = $data->id_compte;

		
		echo $query="INSERT INTO transactions(id_transaction, date_transaction, type_transaction, montant_transaction, id_compte)"
		+ " VALUES('".$id_transaction."','".$date_transaction."','".$type_transaction."', '".$montant_transaction."','".$id_compte."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Transaction ajouté avec succès.'
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

	
	
	//Ajouter une transaction
	AddTransaction();
	
			
	}
?>