<?php
    session_start();



    if(!isset($_SESSION["user"])){
        header("Location:login.php");
        exit;
    }



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home - <?php echo $_SESSION["user"]; ?></title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/postFetch.js" defer></script>
</head>
<body>
<header>
    <div class="leftHeader">
        <a href="home.php"><img src="img/logo_small.png"></a>
        <?php
        if(isset($_COOKIE["id"])){
            echo "(" . $_COOKIE["id"].") " . $_SESSION["user"];
        }
        echo "<input type='hidden' id='user_id' value='".$_COOKIE["id"]."'>";
        echo "<input type='hidden' id='username' value='".$_SESSION["user"]."'>";

        $conn = mysqli_connect("localhost","root","","php_db_prova");
        $query = "select username from users where email in (select admin_email from admins) and username ='". $_SESSION["user"]."'";
        $res = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($res)){
            if($row["username"] == $_SESSION["user"]){
                include_once "admin_button.php";
            }
        }

        ?>
        <a class="home" href="profile.php"><i class="bi bi-person-circle"></i></a>
    </div>

    <?php
        include_once "logout_button.php";

    ?>
</header>
    <div class="hero">
        <article>
            <div class="bacheca">
                <h1>Bacheca</h1>
            </div>

        </article>
    </div>
<footer>
    FoamCloud &copy; 2022 - Daniele Leanza
</footer>
</body>
</html>
