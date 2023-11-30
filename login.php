<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | By Code Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="signup-container">
        <div class="signup-box">
            <div class="registration-desc">
                <h1>Sign Up</h1>
            </div>
            <form method="post" action="login_process.php">
                <label>Username</label>
                <input type="text" placeholder="" name="username" required autocomplete="off" />
                <label>Password</label>
                <input type="password" placeholder="" name="password" required autocomplete="off" />
                <input type="submit" value="Submit" />
            </form>
            <?php
                if(isset($_GET["Error"]) && $_GET["Error"] == "3")
                {
                    echo "<div style='color: rgb(255, 25, 25);'>Invalid login. Please try again.</div>";
                }
                else if(isset($_GET["Error"]) && $_GET["Error"] == "2")
                {
                    echo "<div style='color: rgb(255, 25, 25);'>Please login first.</div>";
                }
                else if(isset($_GET["Success"]) && $_GET["Success"] == "1")
                {
                    echo "<div style='color: rgb(25, 255, 25);'>Account setup sucessful.</div>";
                }
            ?>
        </div>
        <p class="para-2">
            Do not have an account? <a href="signup.php">Sign up here</a>
        </p>
    </div>
</body>

</html>