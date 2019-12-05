<form method="post">
<input type="submit" name="submit" value="Affectation">
</form>

<?php
// Connect to database
include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];


include 'affect.php';
?>