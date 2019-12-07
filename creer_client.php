<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
	function creerClient(){
    global $conn;
		
		// Ajouter les informations sur un conseiller
		$data = json_decode(file_get_contents("php://input"));
		
		$nom = $data->nom;
        $prenom = $data->prenom;
		$email = $data->email;
		$pseudo = $data->pseudo;
		$mot_de_passe = $data->mot_de_passe;
        $type_user = $data->type_user;
        $num_rue = $data->num_rue;
        $nom_rue = $data->nom_rue;
        $code_postal = $data->code_postal;
        $ville = $data->ville;
        $mle_conseiller = $data->mle_conseiller;
        $date_deb_contrat = $data->date_deb_contrat;
        $telephone = $data->telephone;
        $nb_enfants = $data->nb_enfants;
        $statut = $data->statut;
			
		$query="INSERT INTO utilisateur (nom,prenom,email,pseudo, mot_de_passe,type_user) VALUES('".$nom."', '".$prenom."', '".$email."','".$pseudo."','".$mot_de_passe."','".$type_user."')";	
		if(mysqli_query($conn, $query))
		{
            $query="SELECT max(id_user) AS id_user FROM utilisateur";
            $result = (mysqli_query($conn, $query));
            while($row = mysqli_fetch_array($result)){
            $id_user=$row['id_user'];
            }

			$query="INSERT INTO adresse (num_rue,nom_rue,code_postal,ville, id_user) VALUES('".$num_rue."', '".$nom_rue."', '".$code_postal."', '".$ville."', '".$id_user."')";	
			if(mysqli_query($conn, $query))
			{
				$query="INSERT INTO conseiller (mle_conseiller,date_deb_contrat,id_user) VALUES('".$mle_conseiller."','".$date_deb_contrat."', '".$id_user."')";	
				if(mysqli_query($conn, $query))
					{
                        $query="SELECT max(id_conseiller) AS id_conseiller FROM conseiller";
                        $result = (mysqli_query($conn, $query));
                        while($row = mysqli_fetch_array($result)){
                        $id_conseiller=$row['id_conseiller'];
                        }

                        $query="INSERT INTO administrateur (id_conseiller) VALUES('".$id_conseiller."')";	
                        if(mysqli_query($conn, $query))
                        {
                            $query="INSERT INTO client (id_conseiller, id_user, telephone, nb_enfants, statut) VALUES('".$id_conseiller."','".$id_user."','".$telephone."','".$nb_enfants."','".$statut."')";	
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
	
    creerClient();

?>