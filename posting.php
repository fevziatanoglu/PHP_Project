<?php
$mysqli = require "db-connection.php";
session_start();


try {
    $sql_post = "INSERT INTO post (user_id , text , user_name) VALUES ( ? , ? , ?)";

    $stmt_post = $mysqli->stmt_init();
    $stmt_post->prepare($sql_post);

    if (!$stmt_post->prepare($sql_post)) {
        die("SQL Error:" . $mysqli->error);
    }

    // assign variables into sql statment
    $stmt_post->bind_param(
        "sss",
        $_SESSION["user_id"],
        $_POST["post"],
        $_SESSION["user_name"]
    );



    $stmt_post->execute();
    echo '<script>alert("Posting successful!");</script>';

    echo '<script>window.location.href = "index.php";</script>';
    exit;
} catch (Exception $e) {
    die(" SQL ERROR:    " .  $e->getMessage() . " " . $e->getCode());
}
