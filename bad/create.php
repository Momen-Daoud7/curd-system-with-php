<?php
  
    // connect to databse
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_curd','root', '' );
  $pdo->setAttribute(PDO:: ATTR_ERRMODE , PDO:: ERRMODE_EXCEPTION); // GETING ERRORS

// array of errors
  $errors = [];

  // Only if the request is post 
 if($_SERVER['REQUEST_METHOD'] === 'POST') {
	  // getting values from the form
	 $title = $_POST['title'];
	 $image = '';
	 $description = $_POST['description'];
	 $price = $_POST['price'];
	 $date = date("t-m-d h:i:s");

	 if(!$title) {
	 	$errors[] = "product title is require !";
	 }
	 if(!$price) {
	 	 $errors[] = "product price is require !";
	 }
	 // create an images floder to put all images on it
	 if(!is_dir("images")) {
		mkdir("images");
	 }



	 // only insert to database if there's no error
	 if(empty($errors)) {
	 
	 	// uploading images
	 	$image = $_FILES['image'] ?? null;
	 	$imagePath="";
	 	if($image && $image["tmp_name"]) {
	 		$imagePath = "images/".randomname(8)."/".$image['name'];
	 		mkdir(dirname($imagePath));

	 		// move the uploadikng image
	 		move_uploaded_file($image['tmp_name'], $imagePath );
	 	}
	 	
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

	// Genreate Random name for the image
	function randomname($number) {
		$charcators = "1234456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
		$str = "";
		for($i = 0 ; $i < $number ; $i++) {
			$random = rand(0 , strlen($charcators) - 1);
			$str .= $charcators[$random];
		}
		return $str;

	}

?>


<!DOCTYPE html>
<html>
<head>

	<title>Create product</title>
  <link rel="stylesheet" type="text/css" href="./bootstrap-4.4.1.css">

</head>
<body>
	<h1>Create new product</h1>
	<!-- products form -->

	<!-- error messages -->
	<?php if(!empty($errors)):?>
		<div class="alert alert-danger">
			<?php foreach($errors as $error ):?>
				<div><?php echo $error ?></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<form class="col-md-8" action="" method="POST" enctype="multipart/form-data">
		<div class="form-group">
		    <label>product image</label>
		    <input type="file" class="form-control bg-input" name="image" >
		</div>
		<div class="form-group">
		    <label> Product Title</label>
		    <input type="text" class="form-control bg-input" name="title" >
		</div>
		<div class="form-group">
		    <label>Product Description</label>
		    <input type="text" class="form-control bg-input" name="description" >
		</div>
		<div class="form-group">
		    <label>Product Price</label>
		    <input type="number" class="form-control bg-input" name="price" >
		</div>
		<button type="submit" class="btn btn-primary">submit</button>
	</form>
</body>
</html>