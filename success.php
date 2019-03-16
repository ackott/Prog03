<?php

session_start();
if (!$_SESSION) {
        header("Location: login.php");
    }
?>
success!
