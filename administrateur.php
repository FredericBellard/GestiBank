<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getAdministrateurs()
	{
		global $conn;
		$query = "SELECT * FROM administrateur";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getAdmistrateur($mle_admin)
	{
		global $conn;
		$query = "SELECT * FROM administrateur";
		if($mle_admin != 0)
		{
			$query .= " WHERE mle_admin=".$mle_admin." LIMIT 1";
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
	
	function AddAdministrateur()
	{
		global $conn;
		

		// GET DATA FORM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$fonction = $data->fonction;
		$date_deb_contrat = $data->date_deb_contrat;
		$id_conseiller = $data->id_conseiller;
		
		
		echo $query="INSERT INTO administrateur (fonction , date_deb_contrat, id_conseiller) VALUES('".$fonction ."', '".$date_deb_contrat."', '".$id_conseiller."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>' Administrateur ajouté avec succès.'
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
	
	function updateAdministrateur($mle_admin)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$fonction = $data["fonction"];
		$date_deb_contrat = $data["date_deb_contrat"];
		$id_conseiller = $data["id_conseiller"];
		
		$query="UPDATE administrateur SET fonction='".$fonction."', date_deb_contrat='".$date_deb_contrat."', id_conseiller='".$id_conseiller."' WHERE mle_admin=".$mle_admin;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Administrateur mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de l_. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteAdministrateur($mle_admin)
	{
		global $conn;
		$query = "DELETE FROM administrateur  WHERE mle_admin=".$mle_admin;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Administrateur supprimé avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression de l_Administrateur a échoué. '. mysqli_error($conn)
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
			if(!empty($_GET["mle_admin"]))
			{
				$mle_admin=intval($_GET["mle_admin"]);
				getAdministrateur($mle_admin);
			}
			else
			{
				getAdministrateurs();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un produit
			AddAdministrateur();
			break;
			
		case 'PUT':
			// Modifier un produit
			$mle_admin = intval($_GET["mle_admin"]);
			updateAdministrateur($mle_admin);
			break;
			
		case 'DELETE':
			// Supprimer un produit
			$mle_admin = intval($_GET["mle_admin"]);
			deleteAdministrateur($mle_admin);
			break;

	}
?>