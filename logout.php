<?php
    session_start();
    session_destroy();
    setcookie("id","");
    header("Location: login.php");
    exit;
?>