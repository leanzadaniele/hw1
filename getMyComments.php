<?php
if(isset($_COOKIE["id"])){
    $conn = mysqli_connect("localhost","root","","php_db_prova");
    $user = $_COOKIE["id"];
    $results = array();
    $query = "select id, post, comment from commented where user = $user";
    $res = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($res)){
        $results[] = $row;
    }

    echo json_encode($results);
}
else{
    header("Location: login.php");
    exit;
}

?>