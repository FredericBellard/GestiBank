<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
    include("db_connect.php");
    include("creer_client.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
	function creerCompte(){
    global $conn;
		
		// Ajouter les informations sur un conseiller
		$data = json_decode(file_get_contents("php://input"));
		
		$date_demande = $data->date_demande;
        $type_demande = $data->type_demande;
		$numero_compte = $data->numero_compte;
		$date_creation = $data->date_creation;
		$solde = $data->solde;
        $type_compte = $data->type_compte;
                
        $query="SELECT max(id_client) AS id_client FROM client";
            $result = (mysqli_query($conn, $query));
            while($row = mysqli_fetch_array($result)){
            $id_client=$row['id_client'];
            }

		$query="INSERT INTO demande_client(date_demande,type_demande,id_client) VALUES('".$date_demande."', '".$type_demande."', '".$id_client."')";	
		if(mysqli_query($conn, $query))
		{
            $query="INSERT INTO compte (numero_compte,date_creation,solde,type_compte,id_client) VALUES('".$numero_compte."', '".$date_creation."', '".$solde."', '".$type_compte."', '".$id_client."')";	
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
        
            header('Content-Type: application/json');
		echo json_encode($response);
    }
    
    creerCompte();

?>