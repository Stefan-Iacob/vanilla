<?php
    require 'config.php';


    try {
        $connection=new PDO('mysql:host='.host.';dbname='.database, username, password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        print"Error! ". $e->getMessage();
        die();
    }

?>
