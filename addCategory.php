<?php
$name = filter_input(INPUT_POST, 'category_name');
if ($name ==false||$name == null ) {
$error = "Invalid Category data.";
include('CategoryError.php'); 
}
else{
    require_once('databaseConnect.php');
    $query = 'INSERT INTO categories(categoryName)VALUE (:name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name',$name);
    try{$statement->execute();}
	catch(PDOexception $e){
		$error = "Invalid product data. Check all fields and try 
        again. Make sure that NO fields are NULL and that the product code is UNIQUE.";
	    include('addProductError.php');
	    exit();
	}
    $statement->closeCursor();
    $location = 'location: categories.php'; 
	header($location);
}


?>