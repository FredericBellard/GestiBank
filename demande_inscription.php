<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
	function getListDemandeUtilisateur(){
        {
            global $conn;
            $query = "SELECT * FROM demande_client";
            $response = array();
            $result = mysqli_query($conn, $query);
            
            while($row = mysqli_fetch_array($result))
            {
            $response[] = $row;
            //	echo $row[0];
            }
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT);
        }