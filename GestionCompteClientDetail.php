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

	function getGestionCompteClientsDetail()
	{   
		global $conn;
		$query = "SELECT date_transaction, type_transaction, montant_transaction FROM transactions inner join compte on transactions.id_compte=compte.id_compte";
		$response = array();
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
			
		}
		header('Content-Type: application/json');
	    echo json_encode($response, JSON_PRETTY_PRINT);
		
		
	}
	
	function getGestionCompteClientDetail($id_client)
	{
		global $conn;
		$query = "SELECT date_transaction, type_transaction, montant_transaction FROM transactions inner join compte on transactions.id_compte=compte.id_compte";
		if($id_client != 0)
		{
			$query .= " WHERE id_client=".$id_client." LIMIT 1";
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
				getGestionCompteClientDetail($id_client);
			}
			else
			{
				getGestionCompteClientsDetail();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
	}
?>