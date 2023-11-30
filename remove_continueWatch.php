<?php
    session_start();
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
        exit();
    }   
    if(!isset($_GET['id']))
    {
        header("Location: meow.php");
    }
    $currentID = $_GET['id'];
    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

    $sqlStatement = "DELETE FROM user_watch_history WHERE video_id = $currentID";
    $mysqli -> query($sqlStatement);

    header("Location: Index.php");
?>