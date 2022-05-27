<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup_in.css">
    <script src="js/su_validation.js" defer></script>
</head>
<body>

    <div class="topline"></div>

    <section>
        <div class="logo">
            <img src="img/logo_small.png">
        </div>

        <h1>Register</h1>
        <div class="form">

            <form method="post">

                <?php
                session_start();
                if(isset($_SESSION["user"])){
                    header("Location: home.php");
                    exit;
                }

                $host = "localhost";
                $user = "root";
                $pass = "";
                $db = "php_db_prova";
                $conn = mysqli_connect("$host","$user","$pass","$db") or die("error: ".mysqli_connect_error());
                if(isset($_POST["user"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) &&isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["passcheck"])){
                    $username = mysqli_real_escape_string($conn,$_POST["user"]);
                    $name = mysqli_real_escape_string($conn,$_POST["nome"]);
                    $surname = mysqli_real_escape_string($conn,$_POST["cognome"]);
                    $email = mysqli_real_escape_string($conn,$_POST["email"]);
                    $password = mysqli_real_escape_string($conn,$_POST["pass"]);
                    $checkPassword = mysqli_real_escape_string($conn,$_POST["passcheck"]);
                }



                if(!empty($_POST["user"]) && !empty($_POST["email"]) && !empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["pass"]) && !empty($_POST["passcheck"])){
                    $query="select * from users where email = '$email'";
                    $res = mysqli_query($conn,$query);
                    if(mysqli_num_rows($res)>0){
                        echo "<p class='err'>email già in uso</p>";
                    }
                    else{
                        $query = "select * from users where username = '$username'";
                        $res = mysqli_query($conn,$query);
                        if(mysqli_num_rows($res)>0){
                            echo "<p class='err'>username già in uso</p>";
                        }
                        else{
                            if(strlen($username) < 8){
                                echo "<p class='err'>username corto: almeno 8 caratteri</p>";
                            }
                            else{
                                $query = "INSERT INTO users(username,password,name,surname,email) VALUES('$username','$password','$name','$surname','$email');";

                                if($password == $checkPassword){
                                    if($res = mysqli_query($conn,$query)){
                                        $_SESSION["user"] = $username;
                                        if($res = mysqli_query($conn,"select id from users where username ='$username'")){
                                            $row = mysqli_fetch_assoc($res);
                                            setcookie("id",$row["id"]);
                                        }

                                        header("Location: home.php");
                                        exit;
                                    }
                                }
                                else{
                                    echo "<p class='err'>le password non combaciano</p>";
                                }
                            }
                        }
                    }
                }

                ?>

                <div id="errors" class="hidden">
                    <p id="errMsg" class="err"></p>
                </div>
                <label><input type="text" name="user" id="user" placeholder="username"></label>
                <label><input type="text" name="nome" id="name" placeholder="nome"></label>
                <label><input type="text" name="cognome" id="surname" placeholder="cognome"></label>
                <label><input type="email" name="email" id="email" placeholder="example@example.com"></label>
                <label><input type="password" name="pass" id="pass" placeholder="password"></label>
                <label><input type="password" name="passcheck" id="passCheck" placeholder="conferma password"></label>
                <p><a href="login.php">già registrato?</a> &nbsp; <input type="submit" value="registrati"></p>

            </form>
        </div>
        <div class="copyright">
            Copyright &copy; 2022 - all rights reserved
        </div>
    </section>

</body>
</html>