<?php
// ======================== Import Connection ========================
$mysqli = require "db-connection.php";



try {
    $sql = sprintf(
        "Select * from user WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
    echo("Login successful");
    if($user === null){
        throw new Exception("User not found!" , 404);
    }

    

    if(!password_verify($_POST["password"], $user["password"])){
        throw new Exception("Wrong password!" , 1001);
    }

    var_dump($user);
} catch (Exception $e) {
    die(" SQL ERROR:    " .  $e->getMessage() . " " . $e->getCode());
}
