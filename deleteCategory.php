<?php
require_once("databaseConnect.php");
$cat_id=filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
if( $cat_id!=false)
{
    $qurey="DELETE FROM products WHERE categoryID =:cat_id";
    $statement = $db->prepare($qurey);
    $statement ->bindValue(':cat_id',$cat_id);
    $statement -> execute();
    $statement -> closeCursor();
    $qurey2="DELETE FROM categories WHERE categoryID = :cat_id";
    $statement2 = $db->prepare($qurey2);
    $statement2 ->bindValue(':cat_id',$cat_id);
    $statement2 -> execute();
    $statement2 -> closeCursor();

}
$location = 'location: categories.php?'.$category_id;
header($location, false);
?>