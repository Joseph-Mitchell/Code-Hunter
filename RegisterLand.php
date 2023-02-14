<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "root") or die ("Connection Failed");
    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    $addtodatabase = true;

    if (isset($_POST["register"]))
    {
        $email = $_POST["email"];
        $codename = $_POST["codename"];
        $password = $_POST["password"];
        $avatar = $_POST["avatar"];

        if ($_POST["password"] != $_POST["password2"])
        {
            $_SESSION["proposedemail"] = $email;
            $_SESSION["proposedcodename"] = $codename;
            $_SESSION["pwmatch"] = false;
            $addtodatabase = false;
        }
        else
        {
            $_SESSION["pwmatch"] = true;
        }
    }
    else
    {
        header("Location: WelcomePage.php");
    }

    $query = "SELECT * FROM profiledetails WHERE email = '$email'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if (mysqli_num_rows($results) != 0)
    {
        $_SESSION["proposedemail"] = $email;
        $_SESSION["proposedcodename"] = $codename;
        $_SESSION["emailused"] = true;
        $addtodatabase = false;
    }
    else
    {
        $_SESSION["emailused"] = false;
    }

    $query = "SELECT * FROM profiledetails WHERE codename = '$codename'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if (mysqli_num_rows($results) != 0)
    {
        $_SESSION["proposedemail"] = $email;
        $_SESSION["proposedcodename"] = $codename;
        $_SESSION["codenameused"] = true;
        $addtodatabase = false;
    }
    else
    {
        $_SESSION["codenameused"] = false;
    }

    if ($addtodatabase)
    {
        $action = "INSERT INTO profiledetails VALUES ('NULL', '$email', '$codename', \"" . password_hash($password, PASSWORD_DEFAULT) . "\", '$avatar', 'NULL')";
        mysqli_query($connection, $action) or die(mysqli_error($connection));

        $query = "SELECT id FROM profiledetails WHERE codename = '$codename'";
        $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $row = mysqli_fetch_assoc($results);
        $id = $row["id"];

        $action = "INSERT INTO foundcodes VALUES ('$id', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', \"" . date('y.m.d.H.i', time()) . "\", '0', 'NULL')";
        mysqli_query($connection, $action) or die(mysqli_error($connection));

        $_SESSION["codename"] = $codename;

        unset($_SESSION["proposedemail"]);
        unset($_SESSION["proposedcodename"]);
        unset($_SESSION["pwmatch"]);
        unset($_SESSION["emailused"]);
        unset($_SESSION["codenameused"]);

        header("Location: WelcomePage.php");
    }
    else
    {
        header("Location: Register.php");
    }
?>