
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup_in.css">
    <script src="js/script.js" defer></script>

</head>
<body>

    <div class="topline"></div>

    <section>

        <div class="logo">
            <img src="img/logo_small.png">
        </div>

        <h1>Login</h1>
        <div class="form">
            <form method="post">
                <?php
                    session_start();
                    if(isset($_SESSION["user"])) {
                        $conn = mysqli_connect("localhost", "root", "", "php_db_prova");
                        $query = "select username from users where email in (select admin_email from admins)";
                        $res = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($res)) {
                            if ($row["username"] == $_SESSION["user"]) {
                                header("Location:admin_home.php");
                                exit;
                            } else {
                                header("Location: home.php");
                                exit;
                            }

                        }
                    }

                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $db = "php_db_prova";
                    $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());





                /*if(isset($_POST["email"]) && isset($_POST["pass"])){
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
                }*/

                if(isset($_POST["email"]) && isset($_POST["pass"])){
                    $email = mysqli_real_escape_string($conn,$_POST["email"]);
                    $password = mysqli_real_escape_string($conn,$_POST["pass"]);

                    $query = "select * from users where email ='$email'";
                    $res = mysqli_query($conn,$query);
                    if(mysqli_num_rows($res)>0){
                        $query2 = "select * from users where email in (select admin_email from admins where admin_email = '$email')";
                        $res2 = mysqli_query($conn,$query2);
                        if(mysqli_num_rows($res2)>0){
                            $row = mysqli_fetch_assoc($res2);
                            if($_POST["email"] == $row["email"] && $_POST["pass"] == $row["password"]){
                                $_SESSION["user"] = $row["username"];
                                $_SESSION["img"] = $row["propic"];
                                setcookie("id",$row["id"]);
                                header("Location: admin_home.php");
                                exit;
                            }
                            else{
                                echo("<p class='err'> credenziali errate </p>");
                            }
                        }
                        else{
                            $row = mysqli_fetch_assoc($res);
                            if($_POST["email"] == $row["email"] && $_POST["pass"] == $row["password"]){
                                $_SESSION["user"] = $row["username"];
                                $_SESSION["img"] = $row["propic"];
                                setcookie("id",$row["id"]);
                                header("Location: home.php");
                                exit;
                            }
                            else{
                                echo("<p class='err'> credenziali errate </p>");
                            }
                        }
                    }
                    else{
                        echo("<p class='err'> user non esistente </p>");
                    }
                }

                ?>
                <label><input type="email" name="email" placeholder="example@example.com" id="email"></label>
                <label><input type="password" name="pass" placeholder="password" id="password"></label>
                <p><a href="register.php">nuovo utente?</a> &nbsp; <input type="submit" value="accedi"></p>

            </form>
        </div>
        <div class="copyright">
            Copyright &copy; 2022 - all rights reserved
        </div>
    </section>
</body>
</html>