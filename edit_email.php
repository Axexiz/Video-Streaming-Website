<?php
require("dbInfo.php");
$mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

session_start();
if(!isset($_SESSION['fullname']))
{
    header("Location: login.php?Error=2");
    exit();
}
if(isset($_POST['email']))
{
    $newEmail = $_POST['email'];
    $AccountID = $_SESSION['accountID'];

    $sqlStatement = "SELECT * FROM users";
    $result = $mysqli -> query($sqlStatement);
    while($record = $result -> fetch_assoc())
    {
        if($record['email'] == $newEmail){
            header("Location: profilePage.php?Fail=20");
            exit();
        }
    }
    $sql = "UPDATE users SET email = '$newEmail' where id = '$AccountID'";
    $mysqli -> query($sql);

    header("Location: profilePage.php?Sucess=70");

}



?>