<?php
if(isset($_GET["post_id"])){
    $post_id = $_GET["post_id"];
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "php_db_prova";
    $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());

    $query = "SELECT count(post) as numLikes FROM liked where post = $post_id";
    $res = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($res)){
        $likeCount[] = array("id" => $_GET["post_id"],"numLikes" => $row["numLikes"]);
    }

    echo json_encode($likeCount);
}
else{
    echo "error";
}

?>

