<?php
session_start();
if(!isset($_SESSION['fullname']))
{
    header("Location: login.php?Error=2");
    exit();
} 
require("dbInfo.php");
$mysqli = new mysqli($hostname, $dbUser, $dbPass, $db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['videoID'])) {
  $videoID = $_POST['videoID'];
  $timestamp = $_POST['timestamp'];
  $totalTime = $_POST['totalTime'] - 1;
  $accountID = $_POST['accountID'];

  // Check if the video ID exists in the user_watch_history table
  $sqlStatement = "SELECT * FROM user_watch_history WHERE video_id = '$videoID' and user_id='$accountID'";
  $result = $mysqli->query($sqlStatement);
  $count = $result->num_rows;

  if ($count != 0) {
    // If the video ID doesn't exist, insert a new row with video_id and last_watched_time
    $sqlStatement = "UPDATE user_watch_history SET last_watched_time = '$timestamp' WHERE video_id = '$videoID' and user_id = '$accountID'";
  }

  if (!$mysqli->query($sqlStatement)) {
    die('Error in executing the query: ' . $mysqli->error);
  }

  $sqlStatement = "UPDATE user_watch_history SET total_time = '$totalTime' WHERE video_id = '$videoID' and user_id = '$accountID'";
  if (!$mysqli->query($sqlStatement)) {
    die('Error in updating total_time: ' . $mysqli->error);
  }
}
?>