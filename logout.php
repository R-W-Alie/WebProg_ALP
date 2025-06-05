<?php
session_start();
session_unset();    // clear session variables
session_destroy();  // destroy the session

header("Location: home.php"); // redirect to home page
exit;
