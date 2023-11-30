<?php
    session_start();
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
        exit();
    }  
require("dbInfo.php");
$mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

if (isset($_GET['userid']) && isset($_GET['showid']) && isset($_GET['playlistid'])) {
    $userid = $_GET['userid'];
    $showid = $_GET['showid'];
    $playlistid = $_GET['playlistid'];

    $sql = "DELETE FROM playlist_show where show_id = $showid and userID = $userid and playlist_id = $playlistid";
    $mysqli -> query($sql);

    header("Location: Index.php");
}
?>