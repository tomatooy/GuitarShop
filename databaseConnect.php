<?php 
$dbn = 'mysql:host=localhost;dbname=my_guitar_shop1';
$username = 'root';
$password = '';
try {
	$db = new PDO($dbn, $username, $password);
} catch (PDOException $e) {
	$error_message = $e->getMessage();
	include('databaseError.php');
	exit();
}
?>