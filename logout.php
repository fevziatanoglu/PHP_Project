<?php

session_start();

session_destroy();

echo '<script>alert("You logged out. Good bye :)");</script>';

echo '<script>window.location.href = "login-page.html";</script>';

exit;
