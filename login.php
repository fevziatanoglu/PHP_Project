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

    if($user === null){
        // throw new Exception("User not found!" , 404);
        echo '<script>alert("User not found");</script>';
        echo '<script>window.location.href = "login-page.html";</script>';
    }

    

    if(!password_verify($_POST["password"], $user["password"])){
        // throw new Exception("Wrong password!" , 1001);
        echo '<script>alert("Wrong Password");</script>';
        echo '<script>window.location.href = "login-page.html";</script>';
    }
    
    
    echo '<script>alert("Login successfull");</script>';
    session_start();
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_name"] = $user["name"];
    echo '<script>window.location.href = "index.php";</script>';
    exit;
    // var_dump($user);
} catch (Exception $e) {
    die(" SQL ERROR:    " .  $e->getMessage() . " " . $e->getCode());
}


