<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "root") or die ("Connection Failed");
    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    $loginproblem = "";
    $passwordblank = "";
    $codenameblank = "";

    if (isset($_COOKIE["codename"]))
    {
        $_SESSION["codename"] = $_COOKIE["codename"];
    }

    if (isset($_SESSION["loginproblem"]) && $_SESSION["loginproblem"])
    {
        $loginproblem = "<p style = 'color:red'>The codename/password combination you entered was incorrect</p>";
    }
    if (isset($_SESSION["codenameblank"]) && $_SESSION["codenameblank"])
    {
        $codenameblank = "<p style = 'color:red'>Please enter a codename</p>";
    }
    if (isset($_SESSION["passwordblank"]) && $_SESSION["passwordblank"])
    {
        $passwordblank = "<p style = 'color:red'>Please enter a password</p>";
    }

    if (isset($_SESSION["codename"]))
    {
        $descriptiontext = "
        <p>Welcome " . $_SESSION["codename"] . ", I hope you are ready to get to work finding those hidden codes!<br>
           Adding codes to your profile is simple:<br><br>
           First, follow the clues to find the code.<br>
           Then, scan the code with a QR code scanner (You can find many apps for your phone which will do this job).<br>
           Once you have scanned the code, it will be added to your account!<br>
           You will also be able to see your progress to finding all of the codes on the leaderboard.<br>
           So hurry up and get to finding those codes as quickly as you can!</p><br>";

        $form = "
        <form method = 'GET'>
            <input style = 'margin-left:90px' type = 'submit' name = 'profile' value = 'Profile' formaction = 'Profile.php'>
            <input style = 'float:right; margin-right:110px' type = 'submit' name = 'leaderboard' value = 'Leaderboard' formaction = 'Leaderboard.php'>
        </form>";
    }
    else
    {
        $descriptiontext = "
        <p>We at Code Hunters are looking for intrepid explorers to join our team and help out!<br>
           There are currently nine secret QR codes hidden in and around your immediate location. We need you to join up, and search for each of these codes!<br>
           If you are already a part of our team you can log in below, and if you want to join the hunt, press the 'Register Here!' button.</p><br>";
    
        $form = "
        <form action = 'LoginLand.php' method = 'POST'>
            <p>Your Codename:</p>
            <input type = 'text' name = 'codename'>" .
            $codenameblank .
           "<p>Password:</p>
            <input type = 'password' name = 'password'>" .
            $passwordblank .
            $loginproblem .
           "<p>Remember Me<input type = 'checkbox' name = 'rememberme' value = 'true'></p> 
            <input type = 'submit' name = 'login' value = 'Log In'>
            <br><br>
            <p>Don't have an account?</p>
            <input type = 'submit' name = 'gotoregister' value = 'Register Here!' formaction = 'Register.php'>
        </form>";
    }

    $_SESSION["loginproblem"] = false;
    $_SESSION["codenameblank"] = false;
    $_SESSION["passwordblank"] = false;
?>

<html>
    <head>
        <title>Welcome</title>
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <div class = "main" style = "overflow:auto">
            <h1 class = "header"><img class = "header" src = "logo.png">Codehunters</h1>
        </div>
<?php
    if (isset($_SESSION["codename"]))
    {
        echo "
        <br>
        <ul style = 'min-width:550px' class = 'nav'>
            <li class = 'nav'><a class = 'navselected' href = 'WelcomePage.php'>Welcome Page</a></li>
            <li class = 'nav'><a class = 'nav' href = 'Leaderboard.php'>Leaderboard</a></li>
            <li class = 'nav'><a class = 'nav' href = 'Profile.php'>Profile</a></li>
            <li class = 'nav' style = 'float: right'><a class = 'nav' href='Logout.php'>Logout</a></li>
        </ul>
        <br><br>
        ";
    }
?>
        <div style = "width:550px" class = "main">
            <h1>Welcome to Code Hunters</h1>
<?php

    echo $descriptiontext;

    echo $form;
?> 
        </div>
    </body>
</html>