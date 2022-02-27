<?php
$category_id = filter_input(INPUT_POST, 'categoryID', 
FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
if ($category_id == null || $category_id == false || $code == null
	|| $name == null || $price == null || $price == false ) {
$error = "Invalid product data.";
include('addProductError.php'); 
}
else{
    require_once('databaseConnect.php');
    $query = 'INSERT INTO products(categoryID, productCode, productName, listPrice)
    VALUES(:categoryID, :code, :name, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryID',$category_id);
    $statement->bindValue(':code',$code);
    $statement->bindValue(':name',$name);
    $statement->bindValue(':price',$price);
    try{$statement->execute();}
	catch(PDOexception $e){
		$error = "Invalid product data. Check all fields and try 
        again. Make sure that NO fields are NULL and that the product code is UNIQUE.";
	    include('addProductError.php');
	    exit();
	}
    $statement->closeCursor();
    $location = 'location: index.php?categoryID='.$category_id;
    header($location);
}


?>