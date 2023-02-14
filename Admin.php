<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "root") or die ("Connection Failed");
    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    if (isset($_COOKIE["codename"]))
    {
        $_SESSION["codename"] = $_COOKIE["codename"];
    }

    if (!isset($_SESSION["codename"]))
    {
        header("Location: WelcomePage.php");
    }

    $codename = $_SESSION["codename"];
    
    $query = "SELECT * FROM profiledetails WHERE codename = '$codename'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);

    if ($row["admin"] != 1)
    {
        header("Location: WelcomePage.php");
    }

    $passerror = "";

    if (isset($_POST["delete"]))
    {
        if ($_POST["password"] == "")
        {
            $passerror = "<p style = 'color:red'>Please enter your password</p>";

            $bodycontent = "
            <p>Would you like to delete <i>all</i> save data?</p>
            <form method = 'POST'>
                <input type = 'password' name = 'password' placeholder = 'Enter Your Password'><br><br>
                <input type = 'submit' name = 'delete' value = 'Delete'>
            </form>" . $passerror;
        }
        else
        {
            if (password_verify($_POST["password"], $row["password_encrypted"]))
            {
                $id = $row["id"];

                $action = "DELETE FROM profiledetails WHERE id != " . $id;
                mysqli_query($connection, $action) or die(mysqli_error($connection));
                $action = "DELETE FROM foundcodes WHERE playerid != " . $id;
                mysqli_query($connection, $action) or die(mysqli_error($connection));

                $bodycontent = "
                <p style = 'color:maroon'>Save data has been deleted. <a href = 'Leaderboard.php'>Look upon what you have wrought.</a></p>";
            }
            else
            {
                $passerror = "<p style = 'color:red'>Incorrect password</p>";

                $bodycontent = "
                <p>Would you like to delete <i>all</i> save data?</p>
                <form method = 'POST'>
                    <input type = 'password' name = 'password' placeholder = 'Enter Your Password'><br><br>
                    <input type = 'submit' name = 'delete' value = 'Delete'>
                </form>" . $passerror;
            }
        }
    }
    else
    {
        $bodycontent = "
                <p>Would you like to delete <i>all</i> save data?</p>
                <form method = 'POST'>
                    <input type = 'password' name = 'password' placeholder = 'Enter Your Password'><br><br>
                    <input type = 'submit' name = 'delete' value = 'Delete'>
                </form>";
    }
?>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <style>
            a:link {
                color:#cc0000;
            }
            a:visited {
                color:#cc0000;
            }
            a:active {
                color:red;
            }
        </style>
    </head>
    <body>
        <div class = "main">
            <h1>Admin Page</h1>
            <?php echo $bodycontent; ?>
        </div>
    </body>
</html>