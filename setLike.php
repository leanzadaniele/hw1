<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "php_db_prova";
    $conn = mysqli_connect($host,$user,$pass,$db);
    if(isset($_GET["post_id"]) && isset($_GET["user_id"])){
        $pid = $_GET["post_id"];
        $uid = $_GET["user_id"];
        $existQuery = "select user from liked where post = $pid AND user = $uid";
        $res = mysqli_query($conn,$existQuery);
        if(mysqli_num_rows($res) == 0){
            $insertLikeQuery = "insert into liked(post,user) values('$pid','$uid')";
            if(mysqli_query($conn,$insertLikeQuery)){
                echo "ok insert";
            }

        }
        else{
            $removeLikeQuery = "delete from liked where post = $pid and user = $uid";
            if(mysqli_query($conn,$removeLikeQuery)){
               echo "ok delete";
            }
        }
        /*
        $count = "select count(*) as num from liked where post = $pid";
        $resultFin= mysqli_query($conn,$count);
        if(mysqli_num_rows($resultFin) > 0){
            $row = mysqli_fetch_assoc($resultFin);
            echo json_encode($row);
        }
        */
    }

?>