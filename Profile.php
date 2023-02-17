<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "") or die ("Connection Failed");
    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    if (isset($_COOKIE["codename"]))
    {
        $_SESSION["codename"] = $_COOKIE["codename"];
    }

    if (!isset($_SESSION["codename"]))
    {
        header("Location: Register.php");
    }

    $codename = $_SESSION["codename"];

    $pwerror = "";

    if (isset($_POST["update"]))
    {
        $avatar = $_POST["avatar"];
        $query = "UPDATE profiledetails SET icon = '" . $avatar . "' WHERE codename = '" . $codename . "'";
        mysqli_query($connection, $query) or die(mysqli_error($connection));

        if (isset($_POST["password"]))
        {
            if ($_POST["password"] != $_POST["password2"])
            {
                $pwerror = "<p style = 'color:red'>Passwords did not match</p>";
            }
            else if ($_POST["password"] == "")
            {
                $pwerror = "<p style = 'color:red'>Please enter a new password</p>";
            }
            else
            {   
                $password = $_POST["password"];
                $query = "UPDATE profiledetails SET password_encrypted = \"" . password_hash($password, PASSWORD_DEFAULT) . "\" WHERE codename = \"" . $codename . "\"";
                $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
            }
        }
        if ($pwerror == "")
        {
            header("Location: WelcomePage.php");
        }
    }

    $query = "SELECT email, icon FROM profiledetails WHERE codename = '$codename'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $row = mysqli_fetch_assoc($results);
    $email = $row["email"];
    $avatar = $row["icon"];
?>

<html>
    <head>
        <title>Profile</title>
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
                width: 75px;
                height: 75px;
            }

            input[type = "radio"]:checked + img
            {
                outline-width: 3px;
                outline-style: solid;
                outline-color: rgb(0, 0, 0);
            }
        </style>
    </head>
    <body>
        <div class = "main" style = "overflow:auto">
            <h1 class = "header"><img class = "header" src = "logo.png">Codehunters</h1>
        </div>
        <br>
        <ul style = "min-width:550px"class = "nav">
            <li class = "nav"><a class = "nav" href = "WelcomePage.php">Welcome Page</a></li>
            <li class = "nav"><a class = "nav" href = "Leaderboard.php">Leaderboard</a></li>
            <li class = "nav"><a class = "navselected" href = "Profile.php">Profile</a></li>
            <li  class = "nav" style = "float: right"><a class = "nav" href="Logout.php">Logout</a></li>
        </ul>
        <div class = "main">
        <form method = "POST">
            <?php
            echo "
            <p>Email: <input type = 'email' name = 'email' value = '" . $email . "' disabled></p>
            <p>Codename: <input type = 'text' name = 'codename' value = '" . $codename . "' disabled></p>";
            ?>
            <p>Avatar:</p>
            <label>
                <input type = 'radio' name = 'avatar' value = '1' id = "1" required>
                <img src = 'Avatars/avatar.png' alt = 'avatar'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '2' id = "2" required>
                <img src = 'Avatars/avatar_lips.png' alt = 'avatar_lips'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '3' id = "3" required>
                <img src = 'Avatars/avatar_shades.png' alt = 'avatar_shades'>
            </label>
            <br>
            <label>
                <input type = 'radio' name = 'avatar' value = '4' id = "4" required>
                <img src = 'Avatars/avatar_shades_lips.png' alt = 'avatar_shades_lips'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '5' id = "5" required>
                <img src = 'Avatars/avatar_shades_smile.png' alt = 'avatar_shades_smile'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '6' id = "6" required>
                <img src = 'Avatars/avatar_shades_stache.png' alt = 'avatar_shades_stache'>
            </label>
            <br>
            <label>
                <input type = 'radio' name = 'avatar' value = '7' id = "7" required>
                <img src = 'Avatars/avatar_smile.png' alt = 'avatar_smile'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '8' id = "8" required>
                <img src = 'Avatars/avatar_smile_stache.png' alt = 'avatar_smile_stache'>
            </label>
            <label>
                <input type = 'radio' name = 'avatar' value = '9' id = "9" required>
                <img src = 'Avatars/avatar_stache.png' alt = 'avatar_stache'>
            </label>
            <script>
                document.getElementById("<?php echo $avatar?>").checked = true;
            </script>

            <p>Change Password?<input type = 'checkbox' name = 'passchange' id = "passchange" value = 'passchange' onclick = "disablePass()"></p>
            <p>Password: <input type = "password" name = "password" id = "password" pattern = "[A-Za-z0-9]{8,}" title = "Must be 8 characters long minimum, and include only letters or numbers" disabled><br><br>
               Confirm Password: <input type = 'password' name = 'password2' id = "password2" disabled></p>
            <?php echo $pwerror;?>
            <script>
                function disablePass()
                {
                    if (document.getElementById("passchange").checked == true)
                    {
                        document.getElementById("password").disabled = false;
                        document.getElementById("password2").disabled = false;
                    }
                    else
                    {
                        document.getElementById("password").disabled = true;
                        document.getElementById("password2").disabled = true;
                    }
                }
            </script>
            <input type = "submit" name = "update" value = "Update Profile">
        </form>
        </div>
    </body>
</html>