<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
    global $conn;
		
		// Ajouter les informations sur un conseiller
		//$data = json_decode(file_get_contents("php://input"));
			
/* 		$nom = $data->nom;
		$prenom = $data->prenom;
		$email=$data->email;
		$mle_conseiller = $data->mle_conseiller;
		$pseudonyme = $data->pseudonyme;
		$password = $data->password;
		$date_deb_contrat = $data->date_deb_contrat; */
	
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$email = $_POST["email"];
		$mle_conseiller = $_POST["mle_conseiller"];
		$pseudonyme = $_POST["pseudonyme"];
		$password = $_POST["password"];
		$date_deb_contrat = $_POST["date_deb_contrat"];
		$role =1;
		$id_user=-1;
	
		$query="INSERT INTO utilisateur (nom,prenom,email,pseudonyme,password,role) VALUES('".$nom."', '".$prenom."', '".$email."','".$pseudonyme."','".$password."','".$role."')";	
		if(mysqli_query($conn, $query))
		{
			$id_user=$conn->insert_id;
			$query="INSERT INTO conseiller (date_deb_contrat,id_user,mle_conseiller) VALUES('".$date_deb_contrat."', '".$id_user."', '".$mle_conseiller."')";	
			if(mysqli_query($conn, $query))
					{
						$response=array
						(
							'status' => 1,
							'status_message' =>'Votre demande a bien été prise en compte.'
						);
			}else{
						$response=array
						(
						'status' => 0,
						'status_message' =>'ERREUR!.'. mysqli_error($conn)
						);
						echo $query;
					}	
		}else{
			$response=array
			(
			'status' => 0,
			'status_message' =>'ERREUR!.'. mysqli_error($conn)
			);
		}


	//	header('Content-Type: application/json');
	//	echo json_encode($response);
?>