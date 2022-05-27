<?php
    session_start();

    $conn = mysqli_connect("localhost","root","","php_db_prova");
    $query = "select username from users where email not in (select admin_email from admins)";
    $res = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($res)){
        if($row["username"] == $_SESSION["user"]){
            header("Location:home.php");
            exit;
        }
    }


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
    <title>admin - <?php echo $_SESSION["user"]; ?></title>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/admin.js" defer></script>
</head>
<body>

    <header>
       <div class="leftHeader">
           <a href="home.php"><img src="img/logo_small.png"></a>
        <?php
            echo "(" . $_COOKIE["id"]. ") " . $_SESSION["user"];
        ?>

           <a class="home" href="profile.php">
               <i class="bi bi-person-circle"></i>
           </a>
       </div>

        <?php

            include_once "logout_button.php";
        ?>
    </header>
    <div class="hero">

    <article>
        <div class="LeftBar">
            <form method="post">

                <?php

                $conn = mysqli_connect("localhost","root","","php_db_prova");


                if(isset($_POST["newAdminEmail"])){
                    $emailADMIN = mysqli_real_escape_string($conn,$_POST["newAdminEmail"]);
                    $query = "select * from users where email = '$emailADMIN'"; //vedo se esiste l'utente
                    $res = mysqli_query($conn,$query);
                    if(mysqli_num_rows($res)>0){ //se esiste
                        $query = "select * from admins where admin_email = '$emailADMIN'";//vedo se è anche admin
                        $res = mysqli_query($conn,$query);
                        if(mysqli_num_rows($res)>0){ //se è già admin
                            echo("<p class='err'> l'utente è già amministratore </p>");
                        }
                        else{
                            $query = "select * from users where email = '$emailADMIN'";//vedo se è anche admin
                            $res = mysqli_query($conn,$query);
                            $row = mysqli_fetch_assoc($res);
                            $newAdminsId = $row["id"];
                            if(mysqli_query($conn,"insert into admins(id,admin_email) values('$newAdminsId','$emailADMIN')")){
                                echo("<p class='okStatus'>aggiunto con successo</p>");
                            }
                            else{
                                echo("<p class='err'>errore</p>");
                            }
                        }
                    }
                    else{
                        $errore = true;
                    }
                }


                if(isset($errore)){
                    echo("<p class='err'>l'utente NON esiste</p>");
                }


                ?>
                <input type="email" name="newAdminEmail" placeholder="new admin's email">
                <div>
                    <input type="submit" value="add">
                    <input type="reset" value="reset">
                </div>
            </form>

            <a href="new_post.php">
                <div class="newPost">NEW POST</div>
            </a>

        </div>

        <div class="RightBar">

            <!--
            <div class="post">
                ciao
                <div class="delete">
                    <i class="bi bi-x-square"></i>
                </div>
            </div>
            <div class="noPosts">
                no posts
            </div>
            -->

        </div>


    </article>
        <div class="deleteMe">
            <a href="removeAdmin.php"><div id="removeAdmin">rimuovi privilegi admin</div></a>
        </div>

</div>
    <footer>
        FoamCloud &copy; 2022 - Daniele Leanza
    </footer>
</body>
</html>
