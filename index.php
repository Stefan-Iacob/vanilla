<?php



require 'common.php';

//if cart does not exist, create an array named cart
if( !isset($_SESSION['cart'] )) {
$_SESSION['cart'] = array();
}

//cartText stores a string with elements from cart
$cartText=array_to_text($_SESSION['cart']);

//if cart is empty select all products from database
if (!count($_SESSION['cart'])) {
$query=$connection->prepare('SELECT * FROM products');
$query->execute();
}

//if cart is not empty select only elements that are not in the cart
else {
$query =$connection->prepare('SELECT * FROM products WHERE id NOT IN '.$cartText);
$query->execute();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>index</title>
</head>
<body>
<a> 
    <table border=1>
<?php
    foreach($query as $data):
        $img = 'photo'.$data['id'].'.jpg';
?>
    <tr>
    <td>
    <img src= <?= $img ?> width="100" height="100">
    </td>
    <td>
     <?=$data['name'];?>
     <br>
     <?=$data['description'];?>
     <br> 
     <?='Price '.$data['price'];?> 
    </td>
    <td>
    <form method="POST">
    <input type="submit" name="button<?=$data['id']?>" value="Buy <?=$data['name']?>">
    </td>
    </tr>
<?php
if (array_key_exists('button'.$data['id'], $_POST)) {
    $_SESSION['cart'][]= $data['id'];
}
    endforeach;
 ?>
    </table>
</a>
<a href="cart.php">Go to cart</a>
</body>
</html>
