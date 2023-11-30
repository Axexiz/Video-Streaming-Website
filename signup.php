<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up | By Code Info</title>
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
                <h4>Please fill in the necessary details</h4>
            </div>
            <form method="post" action="sign_in_proccess.php" id="signUp_form">
                <label>Fullname</label>
                <input type="text" placeholder="" name="fullname" id="Fullname" autocomplete="off" />


                <label>Username</label>
                <input type="text" placeholder="" name="username" id="Username" required autocomplete="off" />


                <label>Email</label>
                <input type="text" placeholder="" name="email" id="Email" autocomplete="off" />


                <label>Password</label>
                <input type="password" placeholder="" name="password" id="Password" autocomplete="off" />

                <label>Confirm Password</label>
                <input type="password" placeholder="" name="cfmPassword" id="CfmPassword" autocomplete="off"/>


                <input type="submit" value="Submit" />
            </form>
            <?php
                if(isset($_GET["Error"]) && $_GET["Error"] == "2")
                {
                    echo "<br><div style='color: rgb(255, 25, 25);'>Particulars has already been taken.</div>";
                }
            ?>

            <div id="pass_err" style="display: none;color: rgb(255, 25, 25);text-align:center;max-width:20em"></div>
            <div id="email_err" style="display: none;color: rgb(255, 25, 25);text-align:center;max-width:20em"></div>
            <div id="name_err" style="display: none;color: rgb(255, 25, 25);text-align:center;max-width:20em"></div>
        </div>
        <p class="para-2">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </div>

    <script src="js/signup.js"></script>
</body>

</html>