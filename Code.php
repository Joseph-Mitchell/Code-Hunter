<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "") or die ("Connection Failed");
    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    if (!isset($_GET["code"]))
    {
        header("Location: WelcomePage.php");
    }

    switch ($_GET["code"])
    {
        case 183164:
            $code = 1;
            break;
        case 162870:
            $code = 2;
            break;
        case 647138:
            $code = 3;
            break;
        case 851329:
            $code = 4;
            break;
        case 418867:
            $code = 5;
            break;
        case 896218:
            $code = 6;
            break;
        case 187844:
            $code = 7;
            break;
        case 716826:
            $code = 8;
            break;
        case 847261:
            $code = 9;
            break;
        default:
            header("Location: WelcomePage.php");
    }

    if (isset($_COOKIE["codename"]))
    {
        $_SESSION["codename"] = $_COOKIE["codename"];
    }

    if (!isset($_SESSION["codename"]))
    {
        header("Location: WelcomePage.php");
    }

    $codename = $_SESSION["codename"];

    $query = "SELECT profiledetails.codename, profiledetails.id, 
    foundcodes.start_time, foundcodes.finish_time, foundcodes.codesfound, foundcodes.date1, foundcodes.date2, foundcodes.date3, foundcodes.date4, foundcodes.date5, foundcodes.date6, foundcodes.date7, foundcodes.date8, foundcodes.date9
    FROM profiledetails, foundcodes
    WHERE profiledetails.id = foundcodes.playerid AND profiledetails.codename = '$codename'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);

    $id = $row["id"];
    $datefound = $row["date" . $code];
    $dateformatted = date_create_from_format("Y-m-d H:i:s", $datefound);

    $query = "SELECT * FROM foundcodes WHERE date" . $code . " > 0";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $rowcount = mysqli_num_rows($results);

    if ($datefound > 0)
    {
        $bodytext = "
        <h1>You already found this code!</h1>
        <p>You found code " . $code . " before, on the ". $dateformatted->format("jS \of F, Y \a\\t g:iA") . "</p>
        <p>You are 1 of " . $rowcount . " players to have found this code so far.</p>";
    }
    else
    {
        $newcodesfound = $row['codesfound'] + 1;
        $setfoundtime = "UPDATE foundcodes SET date" . $code . " = \"" . date("Y-m-d H:i:s") . "\", codesfound = \"" . $newcodesfound . "\" WHERE playerid = \"" . $id . "\"";
        mysqli_query($connection, $setfoundtime) or die(mysqli_error($connection));

        $bodytext = "
        <h1>Well Done!</h1>
        <p>You've found code " . $code . "!</p>
        <p>You are 1 of " . $rowcount . " players to find this code so far.</p>";
    }

    $query = "SELECT start_time, finish_time, date1, date2, date3, date4, date5, date6, date7, date8, date9 FROM foundcodes WHERE playerid = '$id'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);

    if ($row["date1"] > 0 && $row["date2"] > 0 && $row["date3"] > 0 && $row["date4"] > 0 && $row["date5"] > 0 && $row["date6"] > 0 && $row["date7"] > 0 && $row["date8"] > 0 && $row["date9"] > 0 && $row["finish_time"] <= 0)
    {      
        $starttime = date_create_from_format("Y-m-d H:i:s", $row["start_time"]);
        $datenow = date_create_from_format("Y-m-d H:i:s", date("Y-m-d H:i:s"));
        $datediff = date_diff($starttime, $datenow);

        $setfinishtime = "UPDATE foundcodes SET finish_time = \"" . $datediff->format("00%Y-%M-%D %H:%I:00") . "\", finished = '1' WHERE playerid = \"" . $id . "\"";
        mysqli_query($connection, $setfinishtime) or die(mysqli_error($connection));
    }
?>

<html>
    <head>
        <title>Code <?php echo $code; ?></title>
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <div class = "main" style = "overflow:auto">
            <h1 class = "header"><img class = "header" src = "logo.png">Codehunters</h1>
        </div>
        <br>
        <ul style = "min-width:550px"class = "nav">
            <li class = "nav"><a class = "nav" href = "WelcomePage.php">Welcome Page</a></li>
            <li class = "nav"><a class = "nav" href = "Leaderboard.php">Leaderboard</a></li>
            <li class = "nav"><a class = "nav" href = "Profile.php">Profile</a></li>
            <li  class = "nav" style = "float: right"><a class = "nav" href="Logout.php">Logout</a></li>
        </ul>
        <div class = "main">
        <?php echo $bodytext; ?>
        <p>You can check your progress against our other agents from the leaderboard <a href = "Leaderboard.php">here.</a></p>
        <p>Now get back out there and find the rest of those codes if you haven't got them all yet!</p>
        </div>  
    </body>
</html>