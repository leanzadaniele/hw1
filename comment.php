<?php
    if(isset($_GET["comment"]) && !empty($_GET["comment"]) && isset($_GET["user_id"]) && isset($_GET["post_id"])){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "php_db_prova";
        $conn = mysqli_connect($host,$user,$pass,$db);
        $uid= $_GET["user_id"];
        $pid = $_GET["post_id"];
        $cmt = $_GET["comment"];
        $query = "insert into commented(post,user,comment) values('$pid','$uid','$cmt')";
        if(mysqli_query($conn,$query)){
            echo "ok";
        }
        else{
            echo "ERROR";
        }
    }
?>