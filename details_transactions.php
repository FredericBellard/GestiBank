<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
    $request_method = $_SERVER["REQUEST_METHOD"];
	
	function getDetailsToutesTransactions(){	
        global $conn;
        echo caca;
		$query = "SELECT numero_compte, date_transaction, type_transaction, montant_transaction, nom, prenom 
		FROM compte ct 
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
        INNER JOIN transactions t ON t.id_compte=ct.id_compte";
		$response = array();
		$result = mysqli_query($conn, $query);
        echo " ";
        echo prout;
		while($row = mysqli_fetch_array($result))
		{
		$response[] = $row;
        echo " ";
        echo pipi;
        }
        header('Content-Type: application/json');
        echo " ";
        echo chiotte;
        echo json_encode($response, JSON_PRETTY_PRINT);
        echo " ";
        echo merde;
	}

	function getDetailsTransactions($id_compte){	
        global $conn;
        echo caca;
		$query = 'SELECT numero_compte, date_transaction, type_transaction, montant_transaction, nom, prenom
		FROM compte ct 
		INNER JOIN client c ON ct.id_client=c.id_client
		INNER JOIN utilisateur u ON c.id_user=u.id_user 
        INNER JOIN transactions t ON t.id_compte=ct.id_compte
		WHERE ct.id_compte="'.$id_compte.'"';
		$response = array();
		$result = mysqli_query($conn, $query);
		echo " ";
        echo prout;
		while($row = mysqli_fetch_array($result))
		{
		$response[] = $row;
		echo " ";
        echo pipi;
		}
        header('Content-Type: application/json');
        echo " ";
        echo chiotte;
        echo json_encode($response, JSON_PRETTY_PRINT);
        echo " ";
        echo merde;
	}

	if(!empty($_GET["id_compte"]))
			{
				$id_compte=intval($_GET["id_compte"]);
                getDetailsTransactions($id_compte);
                echo " ";
                echo bof;
			}
			else
			{
                getDetailsToutesTransactions();
                echo " ";
                echo bof;
			}

?>
