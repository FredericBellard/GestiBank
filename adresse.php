<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: DELETE");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getAdresses()
	{
		global $conn;
		$query = "SELECT * FROM adresse";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}

	function getAdresse($id_adresse=0)
    {
        global $conn;
		$query = "SELECT * FROM adresse";
		if($id_adresse != 0)
		{
			$query .= " WHERE id_adresse=".$id_adresse." LIMIT 1";
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

	function AddAdresse()
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
		$num_rue = $data->num_rue;
		$nom_rue = $data->nom_rue;
		$code_postal = $data->code_postal;
		$ville = $data->ville;
		$id_user = $data->id_user;
		
		echo $query="INSERT INTO adresse (num_rue,nom_rue ,code_postal , ville, id_user) VALUES('".$num_rue."', '".$nom_rue."', '".$code_postal."', '".$ville."','".$id_user."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Adresse ajouté avec succès.'
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
	
	function updateAdresse($id_adresse)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$num_rue = $data["num_adresse"];
		$nom_rue = $data["num_rue"];
		$code_postal  = $data["code_postal "];
		$ville = $data["ville"];
		$id_user = $data["id_user"];
		$query="UPDATE adresse SET num_rue ='".$num_rue."', nom_rue='".$nom_rue."', code_postal ='".$code_postal ."', ville='".$ville."', id_user='".$id_user."' WHERE id_adresse =".$id_adresse;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Adresse mis à jour avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'échec de la mise à jour de l_utilisateur. '. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function deleteAdresse($id_adresse)
	{
		global $conn;
		$query = "DELETE FROM adresee WHERE id_adresse=".$id_adresse;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Adresse supprimé avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression de l_Adresse a échoué. '. mysqli_error($conn)
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
			if(!empty($_GET["id_adresse"]))
			{
				$id_adresse=intval($_GET["id_adresse"]);
				getAdresse($id_adresse);
			}
			else
			{
				getAdresses();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un produit
			AddAdresse();
			break;
			
		case 'PUT':
			// Modifier un produit
			$id_adresse = intval($_GET["id_adresse"]);
			updateAdresse($id_adresse);
			break;
			
		case 'DELETE':
			// Supprimer un produit
			$id_adresse = intval($_GET["id_adresse"]);
			deleteAdresee($id_adresse);
			break;

	}
?>