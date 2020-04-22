<?php 

	$host = 'localhost';
    $database = 'games';
    $username = 'administrator';
    $password = 'HmzwrVjOQAEOaWzN';

    try{
    	// Proberen verbinding te maken met de database en de verbinding opslaan in de variable con
		$pdo = new PDO("mysql:host=$host;dbname=$database",$username,$password);
	} catch(PDOException $ex){
    	// Als de verbinding maken mislukt
		echo "Verbinding mislukt: $ex";
}
?>