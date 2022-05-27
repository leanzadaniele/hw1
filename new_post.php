<?php
session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect("localhost","root","","php_db_prova");
    $query = "select username from users where email not in (select admin_email from admins)";
    $res = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($res)) {
        if ($row["username"] == $_SESSION["user"]) {
            header("Location:home.php");
            exit;
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NEW POST</title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/post.css">
</head>
<body>
    <div class="navigator">
        <a href="admin_home.php"><i class="bi bi-arrow-left-circle"></i>&nbsp;back</a>
        <h1>Nuovo post</h1>
        <a href="home.php"><img src="img/logo_small.png"></a>
    </div>
    <form method="post">
        <?php
            if(isset($_POST["content"]) && !empty($_POST["content"])){
                $query = "insert into posts(author,content) values('" .$_COOKIE["id"]. "','" .$_POST["content"] ."')";
                if(mysqli_query($conn,$query)){
                    echo "ok";
                }
                else{
                    echo "error";
                    $err = true;
                }
            }

            if(isset($err)){
                echo "<div class='err'>errore nel caricamento</div>";
            }

        ?>
        <textarea name="content" placeholder="nuovo post..."></textarea>
        <label><input type="submit" value="pubblica">&nbsp; <?php echo $_SESSION["user"]; ?></label>
    </form>
    <footer>
        FoamCloud &copy; 2022 - Daniele Leanza
    </footer>
</body>
</html>
