<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie("codename", "", time() - 3600, "/");
    header("Location: WelcomePage.php");
?>