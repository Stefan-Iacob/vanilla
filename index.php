<?php

session_start();

require 'common.php';

//if cart does not exist, create an array named cart
if( !isset($_SESSION['cart'])) {
$_SESSION['cart'] = array();
}

//cartText stores a string with elements from cart
$cartText = '('.implode(',' , $_SESSION['cart']).')';

//if cart is empty select all products from database
if (!count($_SESSION['cart'])) {
$query='SELECT * FROM products';
}

//if cart is not empty select only elements that are not in the cart
else {
$query = 'SELECT * FROM products WHERE id NOT IN '.$cartText;
}

$statement = $connection->query($query);

//10 is the maximum number of products that can be displayed(there i should use a function that count all elements from database)
for ($i = 0; $i <= 10; ++$i) {

    if (isset($_POST['button'.$i])) {
        $_SESSION['cart'][] = $i;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <a> <?= 'Indexes of the items in the cart:'.implode(',' , $_SESSION['cart']); ?> </a>
<a> 
    <?php
    echo '<table border=1>';

    foreach ($statement as $data):

        $img = 'photo'.$data['id'].'.jpg';
        echo '<tr><td>'.'<img src= "'.$img.'" width="100" height="100">';
        echo '</td><td>'.($data['title']).' ';
        echo '<br>';
        echo ($data['description']).' ';
        echo '<br>';
        echo 'Price:'.$data['price'].'</td>';
        echo '<br>';
        echo '<td><form method="post">
        <input type="submit" name="button'.$data['id'].'"value="Buy '.$data['title'].'"/></td/tr>';
    endforeach;
     ?>
</a>
</body>
</html>

<?php
session_unset();
session_destroy(); 
?>