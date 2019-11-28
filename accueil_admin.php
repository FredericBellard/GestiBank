<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
	function creerConseiller(){
    global $conn;
		
		// Ajouter les informations sur un conseiller
		$data = json_decode(file_get_contents("php://input"));
		
		$nom = $data->nom;
        $prenom = $data->prenom;
		$num_rue = $data->num_rue;
		$nom_rue = $data->nom_rue;
		$code_postal = $data->code_postal;
		$ville = $data->ville;
        $tel_user = $data->tel_user;
		$email = $data->email;
		$password = $data->password;
		$type_user = $data->type_user;
		$date_deb_contrat = $data->date_deb_contrat;
	
	echo $query="INSERT INTO utilisateur (nom,prenom,tel_user,email,password,type_user) VALUES('".$nom."', '".$prenom."', '".$tel_user."', '".$email."','".$password."','".$type_user."')";	
	echo $query="INSERT INTO adresse (num_rue,nom_rue,code_postal,ville) VALUES('".$num_rue."', '".$nom_rue."', '".$code_postal."', '".$ville."')";	
	echo $query="INSERT INTO conseiller (date_deb_contrat) VALUES('".$date_deb_contrat."')";	

		if(mysqli_query($conn, $query))
		{
		$response=array(
		'status' => 1,
		'status_message' =>'Votre demande a bien été prise en compte.'
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

    switch($request_method)
	{			
		case 'POST':
			// Ajouter un conseiller
			creerConseiller();
			break;
     }
?>