<?php
    $connection = mysqli_connect("localhost", "root", "root") or die ("Connection Failed");

    $action = "CREATE DATABASE codehunters";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    mysqli_select_db($connection, "codehunters") or die (mysqli_error($connection));

    $action = "CREATE TABLE profiledetails(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(150) NOT NULL,
        codename VARCHAR(150) NOT NULL,
        password_encrypted VARCHAR(255) NOT NULL,
        icon INT(1) DEFAULT 1 NOT NULL,
        admin TINYINT(1) DEFAULT 0 NOT NULL)";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $action = "CREATE TABLE foundcodes(
        playerid INT(11) PRIMARY KEY,
        codesfound INT(11) DEFAULT 0 NOT NULL,
        date1 DATETIME NULL,
        date2 DATETIME NULL,
        date3 DATETIME NULL,
        date4 DATETIME NULL,
        date5 DATETIME NULL,
        date6 DATETIME NULL,
        date7 DATETIME NULL,
        date8 DATETIME NULL,
        date9 DATETIME NULL,
        start_time DATETIME NOT NULL,
        finish_time TEXT NULL,
        finished TINYINT(1) DEFAULT 0 NOT NULL)";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*admin*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'admin@admin', 'Admin', \"" . password_hash("admin1", PASSWORD_DEFAULT) . "\", 6, 1)";
    mysqli_query($connection, $action) or die(mysqli_error($connection));
    
    $query = "SELECT id FROM profiledetails WHERE codename = 'Admin'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];
    
    $action = "INSERT INTO foundcodes VALUES ('$id', 9, '2019-05-21 00:01:00', '2019-05-21 00:02:00', '2019-05-21 00:02:00', '2019-05-21 00:02:0', '2019-05-21 00:03:00', '2019-05-21 00:04:00', '2019-05-21 00:04:00', '2019-05-21 00:05:00', '2019-05-21 00:05:00', '2019-05-21 00:00:00', '2019-05-21 00:00:00', '1')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*aa*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'a@a', 'aa', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'aa'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 1, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2019-05-23 17:38:39', 'NULL', '2019-05-23 04:57:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*bb*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'b@b', 'bb', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'bb'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 4, 'NULL', '2019-05-23 17:46:53', 'NULL', '2019-05-23 17:47:05', 'NULL', '2019-05-23 17:46:46', 'NULL', '2019-05-23 17:53:37', 'NULL', '2019-05-23 04:58:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*cc*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'c@c', 'cc', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'cc'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 3, 'NULL', '2019-05-23 17:45:58', 'NULL', '2019-05-23 17:45:27', 'NULL', '2019-05-23 17:45:42', 'NULL', '2019-05-23 17:53:37', 'NULL', '2019-05-23 17:06:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*dd*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'd@d', 'dd', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'dd'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 8, '2019-05-23 18:26:44', 'NULL', '2019-05-23 18:27:10', '2019-05-23 18:26:38', '2019-05-23 18:27:16', '2019-05-23 18:26:50', '2019-05-23 18:27:04', '2019-05-23 18:26:56', '2019-05-23 18:27:20', '2019-05-23 18:27:20', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*ee*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'e@e', 'ee', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'ee'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 1, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2019-05-23 17:39:56', 'NULL', '2019-05-23 17:07:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*ff*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'f@f', 'ff', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'ff'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 5, 'NULL', 'NULL', '2019-05-23 18:03:43', '2019-05-23 18:03:19', '2019-05-23 18:03:35', '2019-05-23 18:03:25', 'NULL', 'NULL', '2019-05-23 18:03:50', '2019-05-23 17:07:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*gg*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'g@g', 'gg', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'gg'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 3, 'NULL', 'NULL', 'NULL', '2019-05-23 17:56:29', '2019-05-23 17:56:19', 'NULL', '2019-05-23 17:56:24', 'NULL', 'NULL', '2019-05-23 17:08:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*hh*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'h@h', 'hh', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'hh'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 3, 'NULL', 'NULL', 'NULL', '2019-05-23 17:56:29', '2019-05-23 17:56:19', 'NULL', '2019-05-23 17:56:24', 'NULL', 'NULL', '2019-05-23 17:08:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*ii*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'i@i', 'ii', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 1, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'ii'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 3, 'NULL', 'NULL', 'NULL', '2019-05-23 17:56:29', '2019-05-23 17:56:19', 'NULL', '2019-05-23 17:56:24', 'NULL', 'NULL', '2019-05-23 17:08:00', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    /*test*/
    $action = "INSERT INTO profiledetails VALUES ('NULL', 'test@test', 'Test', \"" . password_hash("password", PASSWORD_DEFAULT) . "\", 7, 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));

    $query = "SELECT id FROM profiledetails WHERE codename = 'Test'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_assoc($results);
    $id = $row["id"];

    $action = "INSERT INTO foundcodes VALUES ('$id', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0', 'NULL')";
    mysqli_query($connection, $action) or die(mysqli_error($connection));
?>