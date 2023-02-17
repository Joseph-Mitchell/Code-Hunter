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
        header("Location: WelcomePage.php");
    }

    $codename = $_SESSION["codename"];

    if (isset($_GET["page"]))
    {
        if ($_GET["page"] < 0)
        {
            $offset = 0;
        }
        else
        {
            $offset = $_GET["page"] * 10;
        }
    }
    else
    {
        $offset = 0;
    }

    $avatarimg[1] = "Avatars/avatar.png";
    $avatarimg[2] = "Avatars/avatar_lips.png";
    $avatarimg[3] = "Avatars/avatar_shades.png";
    $avatarimg[4] = "Avatars/avatar_shades_lips.png";
    $avatarimg[5] = "Avatars/avatar_shades_smile.png";
    $avatarimg[6] = "Avatars/avatar_shades_stache.png";
    $avatarimg[7] = "Avatars/avatar_smile.png";
    $avatarimg[8] = "Avatars/avatar_smile_stache.png";
    $avatarimg[9] = "Avatars/avatar_stache.png";

    $queryplayers = "SELECT profiledetails.codename, profiledetails.icon, foundcodes.codesfound, foundcodes.start_time, foundcodes.finish_time, foundcodes.finished
    FROM profiledetails, foundcodes
    WHERE profiledetails.id = foundcodes.playerid
    ORDER BY foundcodes.finished DESC, foundcodes.finish_time, foundcodes.codesfound DESC, profiledetails.codename
    LIMIT 10 OFFSET $offset";
    $resultsplayers = mysqli_query($connection, $queryplayers) or die(mysqli_error($connection));

    $resultsshown = mysqli_num_rows($resultsplayers);
    if ($resultsshown == 0)
    {
        header("Location: Leaderboard.php");
    }

    $queryuser = "SELECT profiledetails.codename, profiledetails.icon, profiledetails.admin, foundcodes.codesfound, foundcodes.start_time, foundcodes.finish_time, foundcodes.finished
    FROM profiledetails, foundcodes
    WHERE profiledetails.id = foundcodes.playerid
    ORDER BY foundcodes.finished DESC, foundcodes.finish_time, foundcodes.codesfound DESC, profiledetails.codename";
    $resultsuser = mysqli_query($connection, $queryuser) or die(mysqli_error($connection));
?>

<html>
    <head>
        <title>Leaderboard</title>
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <style>      
            td img.picon {
                width: 25px;
                height: 25px;
            }
            th.left {
                text-align: left;
            }
            td.cent {
                text-align: center;
            }
            td.blank {
                background-color: #ffffff;
                border: none;
            }
            td.highlight {
                background-color: #ED8878;
                border-color: #E34C35;
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
            <li class = "nav"><a class = "navselected" href = "Leaderboard.php">Leaderboard</a></li>
            <li class = "nav"><a class = "nav" href = "Profile.php">Profile</a></li>
            <li  class = "nav" style = "float: right"><a class = "nav" href="Logout.php">Logout</a></li>
        </ul>
        <div class = "main">
        <h1>Leaderboard</h1>
        <div style = "min-width:360px; max-width:550px; width:75%">
        <table style = "width:100%">
            <tr>
                <th></th>
                <th></th>
                <th class = "left">Codename</th>
                <th>Codes Found</th>
                <th>Finished?</th>
                <th>Completion Time</th>
            </tr>
<?php
    $place = $offset;
    while($row = mysqli_fetch_assoc($resultsplayers))
    {
        $place++;

        echo "
            <tr>
                <td class = 'cent'>" . $place . "</td>";

        echo "
                <td class = 'cent'><img class = 'picon' src = \"" . $avatarimg[$row["icon"]] . "\"></td>";

        echo "
                <td class = 'left'>" . $row["codename"] . "</td>";

        echo "
                <td class = 'cent'>" . $row["codesfound"] . "</td>";

        if ($row["finished"])
        {
            echo "
            <td class = 'cent'>Finished!</td>";

            $years = (int)substr($row["finish_time"], 0, 15);
            $months = (int)substr($row["finish_time"], 5, 12);
            $days = (int)substr($row["finish_time"], 8, 9);
            $hours = (int)substr($row["finish_time"], 11, 6);
            $minutes = (int)substr($row["finish_time"], 14, 3);

            echo "
            <td class = 'cent'>";
            if ($years > 0)
            {
                echo $years . " years, ";
            }
            if ($months > 0)
            {
                echo $months . " months, ";
            }
            if ($days > 0)
            {
                echo $days . " days, ";
            }
            if ($hours > 0)
            {
                echo $hours . " hours, ";
            }
            if ($minutes > 0)
            {
                echo $minutes . " minutes";
            }
            echo "</td>";
    }
        else
        {
            echo "
                <td class = 'cent'>Not Finished</td>";

            echo "
                <td class = 'cent'>-----</td>";
        }
        echo "
            </tr>";
    }
?> 
            <tr>
                <td class = 'blank'><p></p></td>
            </tr>
            <div>
            <tr>
<?php
    $place = 0;
    while ($row = mysqli_fetch_assoc($resultsuser))
    {
        $place++;

        if ($row["codename"] == $_SESSION["codename"])
        {
            $admin = $row["admin"];

            echo "
                <td class = 'cent highlight'>" . $place . "</td>";

            echo "
                <td class = 'cent highlight'><img class = 'picon' src = \"" . $avatarimg[$row["icon"]] . "\"></td>";

            echo "
                <td class = 'left highlight'>" . $row["codename"] . "</td>";
    
            echo "
                <td class = 'cent highlight'>" . $row["codesfound"] . "</td>";
    
            if ($row["finished"])
            {
                echo "
                <td class = 'cent highlight'>Finished!</td>";

                $years = (int)substr($row["finish_time"], 0, 15);
                $months = (int)substr($row["finish_time"], 5, 12);
                $days = (int)substr($row["finish_time"], 8, 9);
                $hours = (int)substr($row["finish_time"], 11, 6);
                $minutes = (int)substr($row["finish_time"], 14, 3);

                echo "
                <td class = 'cent highlight'>";
                if ($years > 0)
                {
                    echo $years . " years, ";
                }
                if ($months > 0)
                {
                    echo $months . " months, ";
                }
                if ($days > 0)
                {
                    echo $days . " days, ";
                }
                if ($hours > 0)
                {
                    echo $hours . " hours, ";
                }
                if ($minutes > 0)
                {
                    echo $minutes . " minutes";
                }
                echo "</td>";
            }
            else
            {
                echo "
                <td class = 'cent highlight'>Not Finished</td>";
    
                echo "
                <td class = 'cent highlight'>-----</td>";
            }
        }
    }
?>
            </tr>
            </div>
        </table>
        <br>
        <form method = "GET">
            <input type = "hidden" name = "page" id = "page" value = "0">
            <input type = "submit" name = "previous" id = "previous" value = "PREVIOUS" onclick="changePage(-1)">
            <input style = "float:right" type = "submit" name = "next" id = "next" value = "NEXT" onclick="changePage(1)">
        </form>

<?php
    if ($admin == 1)
    {
        echo "
            <br>
            <form action = 'Admin.php' method = 'POST'>
                <input type = 'submit' name = 'adminpage' value = 'Go to Admin page'>
            </form>";
    }
?>
        </div>
        <script>
            function changePage(int)
            {
                document.getElementById("page").value = <?php echo $offset / 10; ?> + int;
            }
<?php
    if ($resultsshown < 10)
    {
        echo "
            document.getElementById('next').disabled = true";
    }
    if ($offset == 0)
    {
        echo "
            document.getElementById('previous').disabled = true";
    }
?>
        </script>
    </div>
    </body>
</html>