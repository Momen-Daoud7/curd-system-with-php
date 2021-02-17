


	<?php if(!empty($errors)): ?>
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
		    <input type="text" class="form-control bg-input" name="title" value="<?php echo $products['title'] ?>">
		</div>
		<div class="form-group">
		    <label>Product Description</label>
		    <input type="text" class="form-control bg-input" name="description" value="<?php echo $products['description'] ?>" >
		</div>
		<div class="form-group">
		    <label>Product Price</label>
		    <input type="number" class="form-control bg-input" name="price" value="<?php echo $products['price'] ?>" >
		</div>
		<button type="submit" class="btn btn-primary">submit</button>
	</form>