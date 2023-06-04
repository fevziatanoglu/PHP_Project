<?php

// ======================== Validations =============================
if (
    empty($_POST["name"]) || empty($_POST["email"])
    || empty($_POST["password"]) || empty($_POST["confirm-password"])
) {
    die("You have to fill all fields!");
}

if (!filter_var($_POST["email"],  FILTER_VALIDATE_EMAIL)) {
    die("Email has to be a valid email address!");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters!");
}

if ($_POST["password"] !== $_POST["confirm-password"]) {
    die("Passwords do not match!");
}

$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

