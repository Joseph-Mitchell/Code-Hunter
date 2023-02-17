<?php
    session_start();
  
    $connection = mysqli_connect("localhost", "root", "") or die ("Connection Failed");
    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    $pwmatch = "";
    $emailused = "";
    $codenameused = "";

    $email = "";
    $codename = "";
    $password = "";
    $avatar = 1;

    if (isset($_COOKIE["codename"]))
    {
        $_SESSION["codename"] = $_COOKIE["codename"];
    }

    if (isset($_SESSION["codename"]))
    {
        header("Location: Profile.php");
    }

    if (isset($_POST["gotoregister"]))
    {
        $codename = $_POST["codename"];
    }

    if (isset($_SESSION["proposedemail"]))
    {
        $email = $_SESSION["proposedemail"];
    }

    if (isset($_SESSION["proposedcodename"]))
    {
        $codename = $_SESSION["proposedcodename"];
    }

    if (isset($_SESSION["pwmatch"]) && !$_SESSION["pwmatch"])
    {
        $pwmatch = "<p id = 'perror'>Passwords did not match</p>";
    }

    if (isset($_SESSION["emailused"]) && $_SESSION["emailused"])
    {
        $emailused = "<p id = 'perror'>This email is already in use</p>";
    }

    if (isset($_SESSION["codenameused"]) && $_SESSION["codenameused"])
    {
        $codenameused = "<p id = 'perror'>This codename is already in use</p>";
    }
?>

<html>
    <head>
        <title>Register</title>
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <style>
            input[type = "radio"]
            {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            input[type = "radio"] + img
            {
                cursor: pointer;
                width: 100px;
                height: 100px;
            }

            input[type = "radio"]:checked + img
            {
                outline-width: 4px;
                outline-style: solid;
                outline-color: rgb(0, 0, 0);
            }

            #perror{
                color:red;
            }
        </style>
    </head>
    <body>
        <div class = "main" style = "overflow:auto">
            <h1 class = "header"><img class = "header" src = "logo.png">Codehunters</h1>
        </div>
        <div class = "main">
        <h1>Register</h1>
        <form action = 'RegisterLand.php' method = 'POST'>
            <p>Email:</p>
<?php
        echo "
            <input type = 'email' name = 'email' value = '" . $email . "' required>";

        echo $emailused;

        echo "
            <p>Codename:</p>
            <input type = 'text' name = 'codename' value = '" . $codename . "' required>";

        echo $codenameused;

        echo "
            <p>Password:</p>
            <input type = 'password' name = 'password' pattern = '[A-Za-z0-9]{8,}' title = 'Must be  characters long minimum, and include only letters or numbers' required>

            <p>Confirm Password:</p>
            <input type = 'password' name = 'password2' required>";
        
        echo $pwmatch;
        ?>
            <p>Select Avatar:</p>            
            <label>
                <input type = 'radio' name = 'avatar' value = '1' required>
                <img src = 'Avatars/avatar.png' alt = 'avatar'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '2' required>
                <img src = 'Avatars/avatar_lips.png' alt = 'avatar_lips'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '3' required>
                <img src = 'Avatars/avatar_shades.png' alt = 'avatar_shades'>
            </label>
            <br>
            <label>
                <input type = 'radio' name = 'avatar' value = '4' required>
                <img src = 'Avatars/avatar_shades_lips.png' alt = 'avatar_shades_lips'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '5' required>
                <img src = 'Avatars/avatar_shades_smile.png' alt = 'avatar_shades_smile'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '6' required>
                <img src = 'Avatars/avatar_shades_stache.png' alt = 'avatar_shades_stache'>
            </label>
            <br>
            <label>
                <input type = 'radio' name = 'avatar' value = '7' required>
                <img src = 'Avatars/avatar_smile.png' alt = 'avatar_smile'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '8' required>
                <img src = 'Avatars/avatar_smile_stache.png' alt = 'avatar_smile_stache'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '9' required>
                <img src = 'Avatars/avatar_stache.png' alt = 'avatar_stache'>
            </label>
            <br><br><br>
            <input type = 'submit' name = 'register' value = 'Register'>
        </form>
        <br>
        <p>Already have an account?</p>
        <form action = "WelcomePage.php" method = "GET">
            <input type = 'submit' name = 'login' value = 'Log In Here'>
        </form>
        </div>
    </body>
</html>