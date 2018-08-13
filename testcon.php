<?php 

$servername = "local";
$database = "drdpdam.db";
$username = "root";
$password = "";

// Create connection

try {
	$conn = new PDO('mysql:host=192.168.0.252;dbname=drdpdam.db', $username, $password);	
	var_dump($conn);
} catch (Exception $e) {
	echo "Gak bisa konek";
	exit;
}
echo "bisa konek";

?>