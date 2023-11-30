<?php
    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);
    session_start();
if(!isset($_SESSION['fullname']))
{
    header("Location: login.php?Error=2");
    exit();
}    
    $AccountID = $_SESSION['accountID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | By Code Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url(images/create_playlist.gif);
            background-position: center;
            background-repeat: none;
            background-size: cover;
            background: linear-gradient(#313131);
            font-family: "Roboto", sans-serif;
            /* border: 2px solid goldenrod; */
            width: 100vw;
            height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to bottom, rgba(10, 10, 10, 0.6) 10%, rgba(10, 10, 10, 0.9) 90%);
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <div class="signup-box">
            <div class="registration-desc">
                <h1>Add a playlist</h1>
            </div>
            <form method="post" action="addList_process.php">
                <label>Name of playlist:</label>
                <input type="text" placeholder="" name="addList" required />
                <input type="submit" value="Submit" />
            </form>
            <?php
                if(isset($_GET["Error"]) && $_GET["Error"] == "120")
                {
                    echo "<div style='color: rgb(255, 25, 25);'>This playlist has already been created.</div>";
                }
                if(isset($_GET["Sucess"]) && $_GET["Sucess"] == "10")
                {
                    echo "<div style='color: rgb(25, 255, 25);'>Playlist added sucessfully.</div>";
                }
            ?>
        </div>
        <p class="para-2">
            Go back to <a href="index.php">homepage</a>
        </p>
    </div>
</body>

</html>