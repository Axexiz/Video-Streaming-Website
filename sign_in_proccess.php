<?php
    $fullname = $_POST['fullname'];
    $userID = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cfmPass = $_POST['cfmPassword'];

    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

    $sqlStatement = "SELECT * FROM users WHERE username = '$userID' OR email = '$email'";
    $result = $mysqli -> query($sqlStatement);
    $count = $result -> num_rows;

    if($count >= 1)
    {
        header("Location: signup.php?Error=2");
    }
    else
    {
        $sql = "INSERT INTO users (fullname,username,email,pass) VALUES('$fullname','$userID','$email','$pass')";
        $mysqli -> query($sql);
        header("Location: login.php?Success=1");
    }

?>