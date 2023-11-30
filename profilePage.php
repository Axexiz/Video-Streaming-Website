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
    $fullname = $_SESSION['fullname'];
    $username = $_SESSION['userID'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['password'];
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
            background-image: url(images/ProfilePage.gif);
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

        ::placeholder {
            color: black;
            font-size: large;
        }

        input {
            font-size: large;
        }

        input:disabled {
            background-color: rgb(186, 182, 182);
            border: none;
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <div class="signup-box">
            <div class="registration-desc">
                <h1>Welcome back
                    <?= $fullname ?>!
                </h1>
            </div>
            <form method="post" action="edit_email.php" id="change_emailForm">
                <label>Username:</label>
                <input type="text" placeholder="<?= $username ?>" disabled />

                <?php
                    $sql = "SELECT email FROM users where id = $AccountID";
                    $result = $mysqli -> query($sql);
                    $record = $result -> fetch_assoc()
                ?>
                <label>Email</label>
                <input type="text" placeholder="<?= $record['email'] ?>" name="email" id="Email" />

                <input type="submit" value="Submit" />
            </form>
            <?php
                if(isset($_GET["Sucess"]) && $_GET["Sucess"] == "70")
                {
                    echo "<div style='color: rgb(25, 255, 25);'>Your email has been updated.</div>";
                }
                else if(isset($_GET["Fail"]) && $_GET["Fail"] == "20")
                {
                    echo "<div style='color: rgb(255, 25, 25);'>This email account exists already.</div>";
                }
            ?>
            <div id="email_err" style="display: none;color: rgb(255, 25, 25);text-align:center;max-width:20em"></div>
        </div>
        <p class="para-2">
            Go back to <a href="index.php">homepage</a>
        </p>
    </div>

    <script src="js/changeEmail.js"></script>
</body>

</html>