<?php 
	 // connect to databse
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_curd','root', '' );
  $pdo->setAttribute(PDO:: ATTR_ERRMODE , PDO:: ERRMODE_EXCEPTION); // GETING ERRORS
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
