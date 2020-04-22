<?php
include 'databaseConnectionAdmin.php';
if(isset($_GET['del'])){
	$id = $_GET['del'];
	$sql = "DELETE FROM guide WHERE id='$id'";
	$pdo->exec($sql);
	header('Location: ../addGuideToDatabase.php');
}