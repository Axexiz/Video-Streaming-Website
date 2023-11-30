<?php
    $ListName = $_POST['addList'];
    session_start();
if(!isset($_SESSION['fullname']))
{
    header("Location: login.php?Error=2");
    exit();
}
    $AccountID = $_SESSION['accountID'];

    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

    $sql = "SELECT * from playlist where userid_FK = '$AccountID'";
    $result = $mysqli -> query($sql);
    while($record = $result -> fetch_assoc())
    {
        if($record['name'] == $ListName)
        {
            header("Location: addPlaylist.php?Error=120");
            exit();
        }
    }

    $sqlStatement = "INSERT INTO playlist (name,userid_FK) VALUES('$ListName','$AccountID')";
    $mysqli -> query($sqlStatement);
    header("Location: addPlaylist.php?Sucess=10");

    
?>