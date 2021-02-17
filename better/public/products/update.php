<?php
  
  $id = $_GET['id'] ?? null;
  if(!$id) {
  	header("location:index.php");
  	exit;
  }

  /** @var $pdo \PDO */

 // connect to databse 
  require_once "../../database.php";
// genreate random name function
  require_once "../../functions.php";

  $statement =  $pdo->prepare("SELECT * FROM products WHERE id = :id");
  $statement->bindValue(":id" , $id);
  $statement->execute();
  $products = $statement->fetch(PDO:: FETCH_ASSOC);
  

	 $title = $products['title'];
	 $image = $products['image'];
	 $description = $products['description'];
	 $price = $products['price'];


// array of errors
  $errors = [];

  // Only if the request is post 
 if($_SERVER['REQUEST_METHOD'] === 'POST') {
	 	
	 	require_once "../../validate.php";
	 	if(empty($errors)) {
		 // insert the vaules into dtabase
		 $statment = $pdo->prepare("UPDATE  products SET title = :title , image= :image , 
		 							description = :description , price = :price WHERE id = :id");
		 // bind values
		 $statment->bindValue(':title' , $title);
		 $statment->bindValue(':image' , $imagePath);
		 $statment->bindValue(':description' , $description);
		 $statment->bindValue(':price' , $price);
		 $statment->bindValue(':id' , $id);

		 // excuet statement
		 $statment->execute();

		 // redirect user to index page
		 header("location: index.php");

	}

}
?>
	<!-- inlcude html header -->
	<?php include "../../views/partials/header.php" ?>

<body>
	<main class="container">
		<h1>Edit <b><?php echo $products['title'] ?></b></h1>
		<a href="index.php" class="btn btn-secondary">Go back to prodcuts</a>

		<!-- display the old image -->
		<?php if($products['image']): ?>
			<img src="../<?php echo $products['image'] ?>" class="thum-image d-block my-4 " width="120px">
		<?php endif; ?>

		<!-- products form -->
		<?php require_once "../../views/products/form.php"?>
	</main>
</body>
</html>