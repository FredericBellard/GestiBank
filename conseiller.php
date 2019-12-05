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
	
	function getConseiller($id_conseiller=0)
	{
		global $conn;
		$query = "SELECT * FROM conseiller";
		if($mle_conseiller != 0)
		{
			$query .= " WHERE id_conseiller=".$id_conseiller." LIMIT 1";
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
		$id_user = $data->id_user;
		$id_conseiller=-1;
		
		echo $query="INSERT INTO conseiller(mle_conseiller,date_deb_contrat,id_user)
		VALUES('".$$mle_conseiller."', '".$date_deb_contrat."', '".$id_user."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Conseiller ajouté avec succès.'
			);
			$id_conseiller=$conn->insert_id;
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

	function updateConseiller($id_conseiller)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$date_deb_contrat = $data["date_deb_contrat"];
		$mle_conseiller = $data["mle_conseiller"];
		$id_user = $data["id_user"];

		$query="UPDATE conseiller SET date_deb_contrat='".$date_deb_contrat."',mle_conseiller='".$mle_conseiller."',  id_user=".$id_user." WHERE id_conseiller=".$id_conseiller;
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
	
	function deleteConseiller($id_conseiller)
	{
		global $conn;
		$query = "DELETE FROM conseiller WHERE id_conseiller=".$id_conseiller;
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
			if(!empty($_GET["id_conseiller"]))
			{
				$id_conseiller=intval($_GET["id_conseiller"]);
				getConseiller($id_conseiller);
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
			$id_conseiller = intval($_GET["id_conseiller"]);
			updateConseiller($id_conseiller);
			break;
			
		case 'DELETE':
			// Supprimer un produit
			$id_conseiller = intval($_GET["id_conseiller"]);
			deleteConseiller($id_conseiller);
			break;

	}
?>