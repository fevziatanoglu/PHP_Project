<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require  "db-connection.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>


    <?php if (isset($user)) : ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand display fw-bold fs-2 text-primary px-2"> WELCOME <?= htmlspecialchars($user["name"])  ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end px-2" id="navbarNav">

                <ul class="navbar-nav">

                    <li class="nav-item active mx-2">
                        <a class="nav-link btn btn-success px-5" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  btn bg-danger px-5 fs-6" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="">


            <div class="py-4 px-2">
                <form class="row d-flex flex-row justify-content-center align-items-center gap-2" action="posting.php" method="post">
                    <input class="col-10" type="text" placeholder="Enter your posts" id="post" name="post">
                    <button type="submit" class="btn  col-1">Share</button>
                </form>
            </div>

        </div>

    <?php else : ?>


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