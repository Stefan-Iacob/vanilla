<?php
    require 'common.php';

    if (!count($_SESSION['cart'])) {
        echo 'Empty cart';
        goto jump;
   }
    
   else{
    $cartText=arrayToText($_SESSION['cart']);
    $query =$connection->prepare('SELECT * FROM products WHERE id IN '.$cartText);
    $query->execute();
   }
?>
    <!DOCTYPE html>
<html>
<head>
	<title>cart</title>
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
    <input type="submit" name="button<?=$data['id']?>" value="Delete <?=$data['name']?>">
    </td>
    </tr>
<?php
if (array_key_exists('button'.$data['id'], $_POST)) {
    unset($_SESSION['cart'][$data['id']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}
    endforeach;
?>
</table>
</a>
<br>
<br>
<br>
<form action="" method="post">

<input type="text" placeholder="name" name="name">
<br>

<textarea name="feedback" placeholder="Contact details"></textarea>
<br>

<textarea name="feedback" placeholder="Comments" cols="50" rows="10"></textarea>
<br>

<input type="submit" name="send" value="Checkout">

</form>
<?php jump: ?>
<br>
<br>
<br>
<a href = "index.php">Go to index</a>
</body>
</html>