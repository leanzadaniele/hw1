
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup_in.css">
</head>
<body>
    <section>
        <h1>Login</h1>
        <div class="form">
            <form method="post">
                <?php
                    session_start();
                    if(isset($_SESSION["user"])){
                        if($_COOKIE["id"]==1){
                            header("Location: admin_home.php");
                            exit;
                        }
                        else{
                            header("Location: home.php");
                            exit;
                        }

                    }

                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $db = "php_db_prova";
                    $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());

                    $email = mysqli_real_escape_string($conn,$_POST["email"]);
                    $password = mysqli_real_escape_string($conn,$_POST["pass"]);

                    $query = "select * from users where email='$email'";
                    $res = mysqli_query($conn,$query);

                if(isset($_POST["email"]) && isset($_POST["pass"])){
                    $row = mysqli_fetch_assoc($res);
                    if($_POST["email"]==$row["email"] && $_POST["pass"]==$row["password"]){
                        $_SESSION["user"]=$row["username"];
                        setcookie("id",$row["id"]);
                        if($row["id"]==1){
                            header("Location: admin_home.php");
                            exit;
                        }
                        else{
                            header("Location: home.php");
                            exit;
                        }
                    }
                    else{
                        echo("<p class='err'> credenziali errate </p>");
                    }
                }
                ?>
                <label><input type="email" name="email" placeholder="example@example.com"></label>
                <label><input type="password" name="pass" placeholder="password"></label>
                <p><a href="register.php">nuovo utente?</a> &nbsp; <input type="submit" value="login"></p>

            </form>
        </div>
        <div class="copyright">
            Copyright &copy; 2022 - all rights reserved
        </div>
    </section>
</body>
</html>