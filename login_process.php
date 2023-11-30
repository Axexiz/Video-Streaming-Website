<?php
    $userID = $_POST['username'];
    $pass = $_POST['password'];

    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

    $sqlStatement = "SELECT * FROM users WHERE username = '$userID' AND pass = '$pass'";
    $result = $mysqli -> query($sqlStatement);
    $count = $result -> num_rows;

    if($count == 1)
    {
        session_start();
        $record = $result -> fetch_assoc();
        $_SESSION['fullname'] = $record['fullname'];
        $_SESSION['userID'] = $record['username'];
        $_SESSION['email'] = $record['email'];
        $_SESSION['password'] = $record['pass'];
        $_SESSION['accountID'] = $record['id'];
        header("Location: index.php");
    }
    else
    {
        header("Location: login.php?Error=3");
    }
?>