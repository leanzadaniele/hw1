<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "php_db_prova";
    $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());

    $posts = array();
    $comments = array();
    $query = "select p.id,username,content from posts p join admins a on a.id=p.author join users u on u.id = a.id";
    $res = mysqli_query($conn,$query);
    while($singlepost = mysqli_fetch_assoc($res)){
        $posts[] = array("id_post"=>$singlepost["id"],"author"=>$singlepost["username"],"content"=>$singlepost["content"]);
    }
    echo json_encode($posts);
?>