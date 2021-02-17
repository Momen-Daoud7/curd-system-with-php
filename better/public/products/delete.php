<?php 
	
  /** @var $pdo \PDO */
	 // connect to databse
	require_once "../../database.php";

	// get the id
	$id = $_POST['id'] ?? null;

	// check if it null
	if(!$id) {
		header("location: index.php");
		exit;
	} 

	// delete from db
	$statment = $pdo->prepare("DELETE  FROM products WHERE id = :id;");
	$statment->bindValue(":id" , $id);
	$statment->execute();
	header("location: index.php");
