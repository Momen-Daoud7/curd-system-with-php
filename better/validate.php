<?php
	 // getting values from the form
	 $title = $_POST['title'];
	 $image = "";
	 $description = $_POST['description'];
	 $price = $_POST['price'];

	 if(!$title) {
	 	$errors[] = "product title is require !";
	 }
	 if(!$price) {
	 	 $errors[] = "product price is require !";
	 }
	 // create an images floder to put all images on it
	 if(!is_dir(__DIR__."/public/images")) {
		mkdir(__DIR__."/public/images");
	 }
	 // only insert to database if there's no error
	 if(empty($errors)) {
	 	
	 	// uploading images
	 	$image = $_FILES['image'] ?? null;
	 	// OLD IMAGE
	 	$imagePath = $products['image'];
	
	 	if($image && $image["tmp_name"]) {
	 		// delete the old image
	 		if($products['image']) {
	 			unlink(__DIR__."/public/".$imagePath);
	 		}
	 		
	 		$imagePath ="images/".randomname(8)."/".$image['name'];
	 		mkdir(__DIR__."/public/".dirname($imagePath));

	 		// move the uploadikng image
	 		move_uploaded_file($image['tmp_name'], __DIR__."/public/".$imagePath );
	 	}
		
	}
