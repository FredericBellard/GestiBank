<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Affect</title>
    <link rel="stylesheet" href="styles.css">
</head>

<form action='save_client.php' method="post">
<?php
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	
    global $conn;

    $query="SELECT demande_client.date_demande,demande_client.type_demande,
      client.id_client, client.adresse,client.telephone,client.sit_matrimon, client.id_conseiller,
        utilisateur.nom,utilisateur.prenom,utilisateur.email,utilisateur.pseudonyme,
        utilisateur.password,utilisateur.role
    FROM demande_client
    INNER JOIN client ON client.id_client = demande_client.id_client
    INNER JOIN utilisateur ON client.id_user = utilisateur.id_user
    where client.id_conseiller=-1 or utilisateur.pseudonyme in('', null) or utilisateur.password in('', null)";
        
    if ($result = mysqli_query($conn, $query)) {
  
        echo "
        <table>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>e-mail</th>
                <th>Date Demande</th>
                <th>Type Demande</th>
                <th>Pseudonyme</th>
                <th>Password</th>
                <th>Conseiller</th>
                <th style='border-style: none;'></th>
            </tr>";
        while ($obj = mysqli_fetch_object($result)) {
            echo "<tr>";
            echo "<td>" . $obj->nom . "</td>";
            echo "<td>" . $obj->prenom . "</td>";
            echo "<td>" . $obj->email . "</td>";
            echo "<td>" . $obj->date_demande . "</td>";
            $type_dem = "Ouverture";
            if($obj->type_demande == 1){
                $type_dem = "demande chequier";
            }
            echo "<td>" . $type_dem . "</td>";
            echo "<td> <input name='pseudonyme' type='text' value='" . $obj->pseudonyme . "'></td>";
            echo "<td> <input name='password' type='text' value='" . $obj->password . "'></td>";
            $optionsConseillers = optionsConseillers($obj->id_conseiller);
            echo "<td> <select name='conseillers'>" . $optionsConseillers . "</select></td>";
            echo "<td> <input type='hidden' name='idclient' value=".$obj->id_client. "></td>";
            echo "<td style='border-style: none;'><input type='submit' value='Save' /></td>";
            echo "</tr>";
        }
        echo " </table>";

        mysqli_free_result($result);
    } else {
        echo mysqli_error($conn);
    }

    function optionsConseillers($id_conseiller){
        global $conn;
		$query = "SELECT id_conseiller,mle_conseiller, nom, prenom FROM conseiller INNER JOIN utilisateur ON utilisateur.id_user = conseiller.id_user";
		$response = "";
		if ($result = mysqli_query($conn, $query))
            while($row = mysqli_fetch_array($result))
            {
                $selected_option="";
                if($id_conseiller==$row[0]){
                    $selected_option="selected";
                }
                $response .= "<option ".$selected_option." id= '$row[0]' value= '$row[0]'>".$row[1]." | ".$row[2]." ".$row[3]."</option>";
                
        }else {
            echo mysqli_error($conn);
        }
        return $response;
    }


?>
</form>