<?php
    $conn = mysqli_connect("localhost","root","","php_db_prova");
    $query = "select * from posts p join admins a on p.author= a.id join users u on a.id=u.id;";
    $res = mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        $result[] = array();
        while($row = mysqli_fetch_assoc($res)){
            $results = $row;
        }
        echo json_encode($results);
    }
    else{
        echo "no posts";
    }
?>