<?php

  /** @var $pdo \PDO */
    // connect to db
	require_once "database.php";
	// genreate random name function
	require_once "functions.php";

// array of errors
  $errors = [];
  $products = [
  	"title" => "",
  	"description" => "",
  	"price" => ""
  ];
  // Only if the request is post 
 if($_SERVER['REQUEST_METHOD'] === 'POST') {
	 
	 require_once "validate.php" ;
	 // only insert to database if there's no error
	 if(empty($errors)) {
	
		// insert the vaules into dtabase
		 $statment = $pdo->prepare("INSERT INTO products (title , image , description , price , create_date)
		 	VALUES (:title, :image , :description , :price , :date)");
		 // bind values
		 $statment->bindValue(':title' , $title);
		 $statment->bindValue(':image' , $imagePath);
		 $statment->bindValue(':description' , $description);
		 $statment->bindValue(':price' , $price);
		 $statment->bindValue(':date' , $date);

		 // excuet statement
		 $statment->execute();

		 // redirect user to index page
		 header("location: index.php");

	}

}

	
?>
	<!-- inlcude html header -->
	<?php include "views/partials/header.php" ?>
<body>
	<main class="container">
		<h1>Create new product</h1>
		<a href="index.php" class="btn btn-secondary my-3">Go back to products</a>
		<!-- products form -->
		<?php require_once "views/products/form.php" ?>
	</main>
</body>
</html>