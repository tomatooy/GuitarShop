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
</head>

<body>
    <div>
        <h1>Product Manager</h1>
    </div>

    <div class='main'>
        <h1>Add Product</h1>
        <form action="addProduct.php" method="post" class="add_product_form">
            <label>Category: 
                <select style='flex: 0 0 188px;' id="category_list" name="categoryID">
			        <?php foreach ($categories as $category) : ?>
			        <option value="<?php echo $category['categoryID']; ?>" <?php if ($category_id == $category['categoryID']) echo 'selected="selected"'; ?>>
			        <?php echo $category['categoryName']; ?>
		    	    </option>
			        <?php endforeach; ?>
			    </select>
            </label>
            <label>Code: <input  type="text" name="code"></label>
            <label>Name: <input  type="text" name="name"></label>
            <label>List Price: <input type="text" name="price"></label>
            <input style="margin-left:150px;" type="submit" value="Add Product">
        </form>
        <p><a href="index.php">View Product List</a></p>


    </div>

</body>
<footer>
	<p class="foot">&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>

</html>