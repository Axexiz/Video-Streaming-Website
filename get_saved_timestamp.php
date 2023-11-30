<?php
session_start();
if(!isset($_SESSION['fullname']))
{
    header("Location: login.php?Error=2");
    exit();
}
    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

    if ( isset($_GET['videoID'])) {
    $videoID = $_GET['videoID'];
    $accountID = $_GET['accountID'];
    // Assuming you have a table named 'user_watch_history' with columns 'video_id' and 'last_watched_time'.
    $query = "SELECT last_watched_time FROM user_watch_history WHERE video_id = ? AND user_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $videoID,$accountID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        echo json_encode(['timestamp' => $record['last_watched_time']]);
    } else {
        // $sqlStatement = "INSERT INTO user_watch_history (video_id) VALUES ('$videoID')"
        // $mysqli->query($sqlStatement);
        echo json_encode(['timestamp' => null]);
    }
}
?>