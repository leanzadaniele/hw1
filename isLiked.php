<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
        exit;
    }

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "php_db_prova";
    $conn = mysqli_connect($host,$user,$pass,$db) or die("Error: ". mysqli_connect_error());

    $uid = $_COOKIE["id"];
    $likedPosts = array();

    $query = "select post from liked where user  = $uid";
    $res = mysqli_query($conn,$query) or die("error: ".mysqli_error($conn));

    while($row = mysqli_fetch_assoc($res)){
        $likedPosts[] = $row["post"];
    }
    echo json_encode($likedPosts);
?>