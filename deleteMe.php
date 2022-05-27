<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_COOKIE["id"])){
        $user_id = $_COOKIE["id"];
        $conn = mysqli_connect("localhost","root","","php_db_prova");
        $query = "delete from users where id = $user_id";
        if(mysqli_query($conn,$query)){
            header("Location: logout.php");
            exit;
        }
        else{
            header("Location: profile.php");
            exit;
        }
    }
    else{
        header("Location: login.php");
        exit;
    }
?>