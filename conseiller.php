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

	function getConseillers()
	{   
		global $conn;
		$query = "SELECT * FROM conseiller";
		$response = array();
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
			
		}
		header('Content-Type: application/json');
	    echo json_encode($response, JSON_PRETTY_PRINT);
		
		
	}
	
	function getConseiller($mle_conseiller=0)
	{
		global $conn;
		$query = "SELECT * FROM conseiller";
		if($mle_conseiller != 0)
		{
			$query .= " WHERE mle_conseiller=".$mle_conseiller." LIMIT 1";
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
	
	function AddConseiller()
	{
		global $conn;
		/*$date_deb_contrat = $_POST["date_deb_contrat"];
		$id_user = $_POST["id_user"];*/

		// GET DATA FORM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$mle_conseiller = $data->mle_conseiller;
		$date_deb_contrat = $data->date_deb_contrat;
		$id_client = $data->id_client;
		
		echo $query="INSERT INTO conseiller(mle_conseiller,date_deb_contrat,id_client)
		VALUES('".$mle_conseiller."', '".$date_deb_contrat."', '".$id_client."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Conseiller ajouté avec succès.'
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

	function updateConseiller($mle_conseiller)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$date_deb_contrat = $data["date_deb_contrat"];
		$id_client = $data["id_client"];

		$query="UPDATE conseiller SET date_deb_contrat='".$date_deb_contrat."', id_client=".$id_client." WHERE mle_conseiller=".$mle_conseiller;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Conseiller mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour du conseiller. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteConseiller($mle_conseiller)
	{
		global $conn;
		$query = "DELETE FROM conseiller WHERE mle_conseiller=".$mle_conseiller;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Conseiller supprimé avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression du conseiller a échoué. '. mysqli_error($conn)
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
			if(!empty($_GET["mle_conseiller"]))
			{
				$mle_conseiller=intval($_GET["mle_conseiller"]);
				getConseiller($mle_conseiller);
			}
			else
			{
				getConseillers();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un produit
			AddConseiller();
			break;
			
		case 'PUT':
			// Modifier un produit
			$mle_conseiller = intval($_GET["mle_conseiller"]);
			updateConseiller($mle_conseiller);
			break;
			
		case 'DELETE':
			// Supprimer un produit
			$mle_conseiller = intval($_GET["mle_conseiller"]);
			deleteConseiller($mle_conseiller);
			break;

	}
?>