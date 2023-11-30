<?php
    session_start();
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
        exit();
    }  
require("dbInfo.php");
$mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

if (isset($_GET['userid']) && isset($_GET['PID'])) {
    $AccountID = $_GET['userid'];
    $PlaylistID = $_GET['PID'];

    $sql = "DELETE FROM playlist where id = $PlaylistID and userid_FK = $AccountID";
    $mysqli -> query($sql);

    $sql = "DELETE FROM playlist_show where playlist_id = $PlaylistID and userID = $AccountID";
    $mysqli -> query($sql);

    header("Location: Index.php");
}
?>