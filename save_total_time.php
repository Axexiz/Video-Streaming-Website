<?php
session_start();
if(!isset($_SESSION['fullname']))
{
    header("Location: login.php?Error=2");
    exit();
} 
require("dbInfo.php");
$mysqli = new mysqli($hostname, $dbUser, $dbPass, $db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['videoID']) && isset($_POST['totalTime']) ) {
    $videoID = $_POST['videoID'];
    $totalTime = $_POST['totalTime'];
    $accountID = $_POST['accountID'];

    $sqlStatement = "UPDATE user_watch_history SET total_time = '$totalTime' WHERE video_id = '$videoID' AND user_id = '$accountID'";
    $result = $mysqli->query($sqlStatement);
    if (!$result) {
        die('Error in updating total_time: ' . $mysqli->error);
    }
}
?>
