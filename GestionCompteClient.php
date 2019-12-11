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

	function getGestionCompteClients()
	{   
		global $conn;
		$query = "select nom, prenom, num_rue, nom_rue, code_postal, ville, id_compte, numero_compte, solde, type_compte from utilisateur inner join adresse on adresse.id_user=utilisateur.id_user inner join client on utilisateur.id_user=client.id_user inner join compte on client.id_client=compte.id_client";
		$response = array();
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
			
		}
		header('Content-Type: application/json');
	    echo json_encode($response, JSON_PRETTY_PRINT);
				
	}
	
	function getgestionCompteClientId($id_client)
	{
		global $conn;
		$query = "select nom, prenom, num_rue, nom_rue, code_postal, ville, id_compte, numero_compte, solde, type_compte from utilisateur inner join adresse on adresse.id_user=utilisateur.id_user inner join client on utilisateur.id_user=client.id_user inner join compte on client.id_client=compte.id_client ";

		if($id_client != 0)
		{
			$query .= " WHERE client.id_client=".$id_client;
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
		
	// Orchestration des différentes fonctions
	switch($request_method)
	{
		
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id_client"]))
			{
				$id_client=intval($_GET["id_client"]);
				getgestionCompteClientId($id_client);
			}
			else
			{
				getGestionCompteClients();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
	}
?>