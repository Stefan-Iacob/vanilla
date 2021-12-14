<?php
    require 'config.php';
    session_start();

    try {
        $connection=new PDO('mysql:host='.host.';dbname='.database, username, password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        print"Error! ". $e->getMessage();
        die();
    }



function array_to_text($array)
{
    $text = '('.implode(',' , $array).')';
    return $text;
};

?>