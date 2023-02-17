<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "") or die ("Connection Failed");
    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    if (isset($_POST["login"]))
    {
        $codename = $_POST["codename"];
        $password = $_POST["password"];

        $query = "SELECT * FROM profiledetails WHERE codename = '$codename'";
        $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $row = mysqli_fetch_assoc($results);
        $passhash = $row["password_encrypted"];

        if ($codename == "")
        {
            $_SESSION["codenameblank"] = true;
        }
        else
        {
            $_SESSION["codenameblank"] = false;
        }
        if ($password == "")
        {
            $_SESSION["passwordblank"] = true;
        }
        else
        {
            $_SESSION["passwordblank"] = false;
        }

        if (!$_SESSION["passwordblank"] && !$_SESSION["codenameblank"])
        {
            if (mysqli_num_rows($results) == 1 && password_verify($password, $passhash))
            {
                $_SESSION["codename"] = $codename;
                $_SESSION["loginproblem"] = false;
                if (isset($_POST["rememberme"]))
                {
                    setcookie("codename", $codename, time() + (86400 * 7), "/");
                }
            }
            else
            {
                $_SESSION["loginproblem"] = true;
            }     
        }
    }
    header("Location: WelcomePage.php");
?>