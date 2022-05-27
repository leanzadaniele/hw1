<?php
    if(isset($_GET["post_id"])){
        $post_id = $_GET["post_id"];
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "php_db_prova";
        $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());

        $query = "SELECT p.id, username, comment, propic FROM posts p join commented c on p.id = c.post join users u on u.id = c.user where p.id = $post_id";
        $comments = array();
        $res = mysqli_query($conn,$query);
        while($cmt = mysqli_fetch_assoc($res)){
            $comments[] = array("id" => $_GET["post_id"],"comments" => $cmt);
        }

        echo json_encode($comments);
    }
    else{
        echo "error";
    }

?>

