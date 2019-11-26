<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: DELETE");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getUtilisateurs()
	{
		global $conn;
		$query = "SELECT * FROM utilisateur";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getUtilisateur($id_user=0)
	{
		global $conn;
		$query = "SELECT * FROM utilisateur";
		if($id_user != 0)
		{
			$query .= " WHERE id_user=".$id_user." LIMIT 1";
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
	
	function AddUtilisateur()
	{
		global $conn;
		
		// GET DATA FROM REQUEST
		$data = json_decode(file_get_contents("php://input"));
		$nom = $data->nom;
		$prenom = $data->prenom;
		$adresse = $data->adresse;
		$tel_user = $data->tel_user;
		$email = $data->email;
		$password = $data->password;
		$type_user = $data->type_user;
		
		echo $query="INSERT INTO utilisateur(nom, prenom, adresse, tel_user, email, password, type_user) VALUES('".$nom."', '".$prenom."', '".$adresse."', '".$tel_user."', '".$email."', '".$password."', '".$type_user."')";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Utilisateur ajouté avec succès.'
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
	
	function updateUtilisateur($id_user)
	{
		global $conn;
		$data = json_decode(file_get_contents("php://input"),true);
		$nom = $data["nom"];
		$prenom = $data["prenom"];
		$adresse = $data["adresse"];
		$tel_user = $data["tel_user"];
		$email = $data["email"];
		$password = $data["password"];
		$type_user = $data["type_user"];
		$query="UPDATE utilisateur SET nom='".$nom."', prenom='".$prenom."', adresse='".$adresse."', tel_user='".$tel_user."', email='".$email."', password='".$password."', type_user='".$type_user."' WHERE id_user=".$id_user;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Utilisateur mis à jour avec succès.'
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
	
	function deleteUtilisateur($id_user)
	{
		global $conn;
		$query = "DELETE FROM utilisateur WHERE id_user=".$id_user;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Utilisateur supprimé avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'La suppression de l_utilisateur a échoué. '. mysqli_error($conn)
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
			if(!empty($_GET["id_user"]))
			{
				$id_user=intval($_GET["id_user"]);
				getUtilisateur($id_user);
			}
			else
			{
				getUtilisateurs();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			// Ajouter un utilisateur
			AddUtilisateur();
			break;
			
		case 'PUT':
			// Modifier un utilisateur
			$id_user = intval($_GET["id_user"]);
			updateUtilisateur($id_user);
			break;
			
		case 'DELETE':
			// Supprimer un utilisateur
			$id_user = intval($_GET["id_user"]);
			deleteUtilisateur($id_user);
			break;

	}
?>