<?php

session_start();
// get user
if (isset($_SESSION["user_id"])) {

    $mysqli = require  "db-connection.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

$mysqli = require "db-connection.php";
$posts = [];



$isShowProfile = false;



// Check if the action parameter is set and execute the function
if (isset($_GET['action']) && $_GET['action'] === 'profile') {
    global $isShowProfile;
    $isShowProfile = true;
}


// fetch all posts
try {

    $sql = "";

    if ($isShowProfile) {
        
        $sql = sprintf(
            "Select * from post where user_id = %s ORDER BY id DESC",
            $mysqli->real_escape_string($_SESSION["user_id"])
        );
    } else {
        $sql =   "Select * from post ORDER BY id DESC";
    }




    $result = $mysqli->query($sql);


    while ($post = $result->fetch_assoc()) {
        // print_r($post);
        array_push($posts, $post);
    }

    $posts_html = `<div class="p-5" >`;

    foreach ($posts as $post) {
        $posts_html .= "<div > $post[user_name] : $post[text]  </div>";
        $posts_html .= " <div>_____________________________________</div>";
    }
    $posts_html .= "</div>";
    
} catch (Exception $e) {
    die(" SQL ERROR:    " .  $e->getMessage() . " " . $e->getCode());
}


?>

<!DOCTYPE html>
<html>

<head>
    <title><?php if ($isShowProfile) : ?>
            Home Page 
        <?php else : ?>
          <?= htmlspecialchars($user["name"])  ?>'s  Profile 
        <?php endif; ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>

    <!-- user homepage -->
    <?php if (isset($user)) : ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand display fw-bold fs-2 text-primary px-2"> WELCOME <?= htmlspecialchars($user["name"])  ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end px-2" id="navbarNav">

                <ul class="navbar-nav">

                    <li class="nav-item active mx-2">
                        <a href=<?php if (!$isShowProfile) : ?> ?action=profile <?php else : ?> ?action=home <?php endif; ?> class="nav-link btn btn-success px-5" href="#">
                            <?php if ($isShowProfile) : ?>
                                Home Page
                            <?php else : ?>
                                Profile
                            <?php endif; ?>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link  btn bg-danger px-5 fs-6" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>



        <!-- POSTING FORM -->
        <div class="">


            <div class="py-4 px-2">
                <form class="row d-flex flex-row justify-content-center align-items-center gap-2" action="posting.php" method="post">
                    <input class="col-10" type="text" placeholder="Enter your posts" id="post" name="post">
                    <button type="submit" class="btn  col-1">Share</button>
                </form>
            </div>

        </div>

        <!-- POSTS -->
        <div class="container d-flex flex-column justify-content-center align-items-center fs-1 gap-5">

            <?= ($posts_html)   ?>

        </div>

    <?php else : ?>

        <!-- home page without user -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand display fw-bold fs-2 px-2"> HEY LET'S LOG IN ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end px-2" id="navbarNav">

                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link  btn bg-success fs-6 px-5" href="login-page.html">Login</a>
                    </li>
                </ul>
            </div>
        </nav>

    <?php endif; ?>

</body>

</html>