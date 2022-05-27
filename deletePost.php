<?php
session_start();
if(isset($_SESSION["user"])){
    if(isset($_GET["post_id"])) {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "php_db_prova";
        $conn = mysqli_connect("$host", "$user", "$pass", "$db") or die("error: " . mysqli_connect_error());

        $me = $_COOKIE["id"];
        $id_post = $_GET["post_id"];

        $query = "delete from posts where author = $me and id = $id_post";

        if(mysqli_query($conn, $query)){
            echo "ok delete";
        }
        else{
            echo "err delete";
        }
    }
}
else{
    header("Location: login.php");
    exit;
}
?>