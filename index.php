<?php
  
    // connect to databse
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_curd','root', '' );
  $pdo->setAttribute(PDO:: ATTR_ERRMODE , PDO:: ERRMODE_EXCEPTION); // GETING ERRORS

  $search = $_GET['search'] ?? "";

  if($search) {
    $statement = $pdo->prepare("SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC");
    $statement->bindValue(":title" , "%$search%");
  } else {
    $statement = $pdo->prepare("SELECT * FROM products ORDER BY create_date DESC");
  }
  // GET DATA
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
  <main class="container">
    <h1>Products Table</h1>
    <a href="create.php"  class="btn btn-success">Create product</a>

    <!-- search section -->
    <form>
        <div class="input-group mt-3">
            <input type="text" name="search" 
                    placeholder="search for products" 
                    class="form-control"
                    value="<?php echo $search ?>" >
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </div>
    </form>
	  <table class="table">
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
                    <td >
                      <img src="<?php echo $product['image'] ?>"  class ="thum-image" width="50px">
                    </td>
                    <td ><?php echo $product['title']?> </td>
                    <td ><?php echo $product['create_date']?> </td>
                    <td><?php echo $product['price']?> </td>
                    <td>
                      <a  href="update.php?id=<?php echo $product['id'] ?>" class="outline btn btn-sm btn-outline-primary">Edit</a>
                      <form action="delete.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                        <button class="outline btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                    </td>
                 </tr>
               <?php } ?>
                 
             </tbody>
         </table>
</main>
</body>
</html>