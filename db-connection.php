<?php

    $host = "localhost";
    $dbname= "js-project-db";
    $username = "root";
    $password = "";



    try{
        $mysqli = new mysqli( hostname : $host  , username: $username , password: $password , database:  $dbname);
         echo "Connected db successfully! ";
         return $mysqli;
    }catch(Exception $e){
        die(" Database connection error : " . $e->getMessage() . " "  . $e->getCode());
    }


   
    
