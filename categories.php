<?php
require_once('databaseConnect.php');
$query_allCats = 'SELECT * FROM categories ORDER BY categoryID';
$statement = $db->prepare($query_allCats);
$statement -> execute();
$categories = $statement -> fetchAll();
$statement -> closeCursor();
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

        <div class='cate_main'>
            <h1 class="yellowWord">Category List</h1>
            <table>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                <?php foreach ($categories as $category):?>
                <tr>
                    <td>
                        <?php echo $category['categoryName']; ?>
                    </td>
                    <td>
                        <form action="deleteCategory.php" method="post">
                            <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>">
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
                <?php endforeach?>
                </table>
                <h2 class="yellowWord">Add Category</h2>
                    <form action="addCategory.php" method="post" id="add_category_form">
                        <label style="width:400px;">Name:
                        <input style="margin-left:50px;flex:0 0 130px;" type="text" name="category_name">
                        <input style="padding:0; margin-left:14px; flex:0 0 40px;" type="submit" value="Add">
                    </label>
                    </form>
        </div>
        <div id="list_product">
        <a href="index.php" >List Products</a>
        </div>
    </body>
    <footer>
	<p class="foot">&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer> 

    </html>