<?php
    session_start();
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
        exit();
    }
require("dbInfo.php");
$mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);
if (isset($_GET['vidID']) && isset($_GET['AccountID']) && isset($_GET['PID'])) {
    $vidID = $_GET['vidID'];
    $AccountID = $_GET['AccountID'];
    $PID = $_GET['PID'];
    $Page = $_GET['page'];


    $Statement = "INSERT INTO playlist_show (playlist_id,show_id,userID) VALUES('$PID','$vidID','$AccountID')";
    $mysqli -> query($Statement);

    if($Page == "index")
    {
        header("Location: index.php");
    }
    elseif($Page == "movie")
    {
       header("Location: Movies.php"); 
    }
    elseif($Page == "SearchPage")
    {
        header("Location: search_result.php"); 
    }
    elseif($Page == "upComing")
    {
        header("Location: Upcoming.php"); 
    }
    

}
else{
    header("Location: index.php");
}

?>