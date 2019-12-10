<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
	function AddDemandeCompte(){
    global $conn;
		
		// Ajouter les informations sur un conseiller
		$data = json_decode(file_get_contents("php://input"));
		
		$nom = $data->nom;
        $prenom = $data->prenom;
		$num_rue = $data->num_rue;
		$nom_rue = $data->nom_rue;
		$code_postal = $data->code_postal;
		$ville = $data->ville;
		$id_user=$data->id_user;
		$id_client=$data->id_client;
        $email = $data->email;
		$pseudo = $data->pseudo;
		$password = $data->password;
		$role = $data->role;
        $date_demande = $data->date_demande;
        $type_demande = $data->type_demande;
			
		$query="INSERT INTO utilisateur (nom,prenom,email,pseudo, password,role) VALUES('".$nom."', '".$prenom."', '".$email."','".$pseudo."','".$password."','".$role."')";	
		if(mysqli_query($conn, $query))
		{
			$query="INSERT INTO adresse (num_rue,nom_rue,code_postal,ville, id_user) VALUES('".$num_rue."', '".$nom_rue."', '".$code_postal."', '".$ville."', '".$id_user."')";	
			if(mysqli_query($conn, $query))
			{
				$query="INSERT INTO demande_client (date_demande,type_demande,id_client) VALUES('".$date_demande."', '".$type_demande."', '".$id_client."')";	
				if(mysqli_query($conn, $query))
					{
						$response=array
						(
							'status' => 1,
							'status_message' =>'Votre demande a bien été prise en compte.'
						);
					}
				else
					{
						$response=array
						(
						'status' => 0,
						'status_message' =>'ERREUR!.'. mysqli_error($conn)
						);
						echo $query;
					}
			}
			else
				{
					$response=array
					(
					'status' => 0,
					'status_message' =>'ERREUR!.'. mysqli_error($conn)
					);
				}
			
		}
		else
		{
			$response=array
			(
			'status' => 0,
			'status_message' =>'ERREUR!.'. mysqli_error($conn)
			);
		}


		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
    switch($request_method)
	{			
		case 'POST':
			// Ajouter une demande d'ouverture de compte
			AddDemandeCompte();
			break;
    }
?>