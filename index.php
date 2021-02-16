<?php
  
    // connect to databse
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_curd','root', '' );
  $pdo->setAttribute(PDO:: ATTR_ERRMODE , PDO:: ERRMODE_EXCEPTION); // GETING ERRORS

  // GET DATA
  $statement = $pdo->prepare("SELECT * FROM products ORDER BY create_date DESC");
  $statement->execute();
  $products = $statement->fetchAll(PDO:: FETCH_ASSOC) ;


?>

<!DOCTYPE html>
<html>
<head>
	<title>CURD App</title>
  <link rel="stylesheet" type="text/css" href="./bootstrap-4.4.1.css">
</head>
<body>
    <h1>Products Table</h1>
    <a href="create.php"  class="btn btn-success">Create product</a>
	  <table class="table col-md-10 mx-auto">
	  		<thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">image</th>
                   <th scope="col">title</th>
                   <th scope="col">create_date</th>
                   <th scope="col">price</th>
                   <th scope="col">action</th>

                </tr>
            </thead>
            <tbody>

              <!-- display products data -->
                <?php forEach($products as $i => $product ) {?>
               	<tr>
                    <th row="scope"> <?php echo $i + 1?></th>
                    <td ></td>
                    <td ><?php echo $product['title']?> </td>
                    <td ><?php echo $product['create_date']?> </td>
                    <td><?php echo $product['price']?> </td>
                    <td>
                      <button class="outline btn btn-sm btn-outline-primary">Edit</button>
                      <button class="outline btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>
               <?php } ?>
                 
             </tbody>
         </table>

</body>
</html>