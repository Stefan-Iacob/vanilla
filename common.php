<?php
    require 'config.php';


    try {
        $connection=new PDO('mysql:localhost;dbname=products',username,password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //print "Connected!";
        //print nl2br("\n\r\n");
    }
    catch(PDOException $e) {
        print"Error! ". $e->getMessage();
        die();
    }

?>
