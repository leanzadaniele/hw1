<?php
    session_start();
    if(isset($_SESSION["user"])){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "php_db_prova";
        $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());

        $me = $_COOKIE["id"];
        $query = "select id, content from posts where author = $me";

        $res = mysqli_query($conn,$query);

        $myPosts = array();
        while($row = mysqli_fetch_assoc($res)){
            $myPosts[] = $row;
        }

        echo json_encode($myPosts);
    }
    else{
        header("Location: login.php");
        exit;
    }

?>