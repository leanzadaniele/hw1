<?php
    session_start();
    if(isset($_SESSION["user"]) && isset($_COOKIE["id"])){
        if(isset($_GET["urlImg"])){

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "php_db_prova";
            $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());

            $query = "UPDATE users SET propic = '".$_GET["urlImg"]."' where id = ".$_COOKIE["id"];
            $_SESSION["img"] = $_GET["urlImg"];
            if(mysqli_query($conn,$query)){
                echo "ok";
            }
            else{
                echo "err";
            }
        }
    }
    else{
        header("Location: login.php");
        exit;
    }
?>