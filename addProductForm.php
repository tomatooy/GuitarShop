<?php
require_once('databaseConnect.php');
$category_id = filter_input(INPUT_GET, 'categoryID',FILTER_VALIDATE_INT);
$query = 'SELECT *
FROM categories
ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Guitar Shop</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="productManager">
        <h1>Product Manager</h1>
    </div>

    <div class='addproduct_main'>
        <h1 class="yellowWord" >Add Product</h1>
        <form action="addProduct.php" method="post" class="addproduct_form">
            <div>
                <label>Category: 
                </label>
                <select id="category_list" name="categoryID" >
			        <?php foreach ($categories as $category) : ?>
			        <option  value="<?php echo $category['categoryID']; ?>" <?php if ($category_id == $category['categoryID']) echo 'selected="selected"'; ?>>
			        <?php echo $category['categoryName']; ?>
		    	    </option>
			        <?php endforeach; ?>
			    </select>
            </div>
            <div>
            <label>Code: </label>
            <input  type="text" name="code" >
             </div>
             <div>
            <label>Name: </label>
            <input  type="text" name="name">
            </div>
            <div>
            <label>List Price: </label>
            <input type="text" name="price">
            </div>
            <div>
            <label></label>
            <input type="submit" value="Add Product">
            </div>
        </form>
        <p><a href="index.php">View Product List</a></p>


    </div>

</body>
<footer>
	<p class="foot">&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer> 

</html>