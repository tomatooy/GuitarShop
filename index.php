<?php
try {
$dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';
$username = 'root';
$password = '';
$db = new PDO($dsn,$username,$password);
} catch(PDOException $e) {
  $error_message = $e -> getMessage();
  echo "<p> An error occured while connecting to the database: $error_message </p>";
}

$category_id = filter_input(INPUT_GET, 'categoryID',FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id ==  FALSE) {
	$category_id = 1;
}
//category selection query
$queryCategory = "SELECT * FROM categories WHERE categoryID = :categoryID";
$statement1 = $db ->prepare($queryCategory);
$statement1 -> bindValue(':categoryID', $category_id);
$statement1 -> execute();
$category = $statement1 -> fetch();
$category_name = $category['categoryName'];
$statement1 -> closeCursor();
//All categorys
$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
$statement2 = $db -> prepare($queryAllCategories);
$statement2 -> execute();
$categories = $statement2 -> fetchAll();
$statement2 -> closeCursor();
//Product of a category
$queryProducts = 'SELECT * FROM products WHERE categoryID = :categoryID ORDER BY productID';
$statement3 = $db -> prepare($queryProducts);
$statement3 -> bindValue(':categoryID', $category_id);
$statement3 -> execute();
$products = $statement3 -> fetchAll();
$statement3 -> closeCursor();



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
            <h2>Product List</h2>
            <div>
                <h2><a href="categories.php">Categories</a></h2>
				<ul class="links">
					<?php foreach ($categories as $category) : ?>
					<li>
						<a href="?categoryID=<?php echo $category['categoryID']; ?>">
							<?php echo $category['categoryName']; ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
            <div class="products">
                    <table>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Country</th>
                        </tr>
                        <?php foreach ($products as $product) : ?>
                        <tr>
                            <td>
                                <?php echo $product['productCode']; ?>
                            </td>
                            <td>
                                <?php echo $product['productName']; ?>
                            </td>
                            <td class="right">
                                <?php echo $product['listPrice']; ?>
                            </td>
                            <td>
                                <form action="deleteProduct.php" method="post">
                                    <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
                                    <input type="hidden" name="categoryID" value="<?php echo $product['categoryID']; ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <a href="addProductForm.php?categoryID=<?php echo $category_id ?>">Add Product</a>
            </div>
        </div>
        <footer>
	<p class="foot">&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer> 
</body>


</html>