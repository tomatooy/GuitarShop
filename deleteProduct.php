<?php
require_once('databaseConnect.php');
$productID =  filter_input(INPUT_POST,'productID',FILTER_VALIDATE_INT);
$categoryID=  filter_input(INPUT_POST,'categoryID',FILTER_VALIDATE_INT);
if($productID!=false&&$categoryID!=false){
    $query='DELETE FROM products WHERE productID = :productID';
    $statement = $db->prepare($query);
    $statement->bindValue(':productID',$productID);
    $statement->execute();
    $statement->closeCursor();  
}
$localtion = 'location: index.php?categoryID='.$categoryID;
header($localtion);

?>