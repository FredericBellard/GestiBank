<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
    include("db_connect.php");
    include("creer_compte.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
	function creerCompteRem(){
    global $conn;
		
		// Ajouter les informations sur un conseiller
		$data = json_decode(file_get_contents("php://input"));
		
		$taux_interet = $data->taux_interet;
        $facilite_caisse = $data->facilite_caisse;
		$montant_debit = $data->montant_debit;
	                
        $query="SELECT max(id_compte) AS id_compte FROM compte";
            $result = (mysqli_query($conn, $query));
            while($row = mysqli_fetch_array($result)){
            $id_compte=$row['id_compte'];
            }

		$query="INSERT INTO compte_rem(taux_interet,id_compte,facilite_caisse,montant_debit) VALUES('".$taux_interet."', '".$id_compte."', '".$facilite_caisse."', '".$montant_debit."')";	
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
        
            header('Content-Type: application/json');
		echo json_encode($response);
    }
    
    creerCompteRem();

?>