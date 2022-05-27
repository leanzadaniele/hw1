<?php
if(isset($_COOKIE["id"]) && isset($_GET["post_id"])){
    $conn = mysqli_connect("localhost","root","","php_db_prova");
    $user = $_COOKIE["id"];
    $pid = $_GET["post_id"];
    $results = array();
    $query = "delete from commented where id = $pid AND user = $user";
    if(mysqli_query($conn,$query)){
        echo "delete ok";
    }
    else{
        echo "delete error";
    }

}
else{
    header("Location: login.php");
    exit;
}

?>