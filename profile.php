<?php
    session_start();

    if(!isset($_SESSION["user"])){
        header("Location: login.php");
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
    <title>profilo - <?php echo $_SESSION["user"] ?></title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="js/propic.js" defer></script>
    <script src="js/myComments.js" defer></script>
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
        <a class="home" href="home.php"><i class="bi bi-house-fill"></i></a>
    </div>

    <?php
    include_once "logout_button.php";
    ?>
</header>
<article>
    <div class="propic">
        <div class="overlay">
            <i class="bi bi-pencil"></i>
        </div>
        <?php
        $img = $_SESSION["img"];
        echo "<img src='$img' id='propic'>";
        ?>
    </div>

    <h1><?php echo $_SESSION["user"];?></h1>
    <p>clicca sulla foto per poterla cambiare</p>

    <div id="container" class="hidden">
        <h2>modifica foto profilo:</h2>
        <input type="text" placeholder="es(ferrari, computer...)" id="search">
        <div class="modal">

            <p>cerca immagini</p>
        </div>

        <a id="save">
            salva&nbsp;<i class="bi bi-upload"></i>
        </a>
        <div class="powered">
            powered by <img src="img/unsplash.png">
        </div>
    </div>

    <div class="commentsDiv">
        <h2>i miei commenti:</h2>
    </div>

    <div class="deleteMe">
        <a href="deleteMe.php"><div id="deleteUser">elimina account</div></a>
    </div>

</article>

<footer>
    FoamCloud &copy; 2022 - Daniele Leanza
</footer>
</body>
</html>
