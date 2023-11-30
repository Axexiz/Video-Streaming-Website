<?php
session_start();
if(!isset($_SESSION['fullname']))
{
    header("Location: login.php?Error=2");
    exit();
}  

if (isset($_SESSION['category_data'])) {
    unset($_SESSION['category_data']); // Remove the session variable
}

header("Location: Movies.php"); // Redirect back to Movies.php
exit();
?>