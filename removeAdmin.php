<?php
session_start();
if(isset($_SESSION["user"]) && isset($_COOKIE["id"])){
    $admin_id = $_COOKIE["id"];
    $conn = mysqli_connect("localhost","root","","php_db_prova");
    $query = "delete from admins where id = $admin_id";
    if(mysqli_query($conn,$query)){
        header("Location: profile.php");
        exit;
    }
    else{
        header("Location: admin_home.php");
        exit;
    }
}
else{
    header("Location: login.php");
    exit;
}
?>