<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Filmy</title>
    <link rel="stylesheet" href="/strona/css/style.css">
</head>
<body>
    <div class="wrapp">
        <?php
        if(isset($_SESSION["id"])){
            header("Location: ". "/strona/index.php");
        }

        if(isset($_POST["login"]) && isset($_POST["password"])){
            $con = new mysqli("localhost", "root", "", "movies");
            $sql = "SELECT `id` FROM `users` WHERE `login` = '".$_POST["login"]."' AND `password` = '".$_POST["password"]."' AND `is_admin` = '1';";
            $res = $con->query($sql);
            $con->close();
            while($row = $res->fetch_assoc()){
                $_SESSION["id"]=$row["id"];
                $_SESSION["isAdmin"] = true;
                header("Location: ". "/strona/index.php");
            }
        }
        ?>
        <div class="header">
            <h3>Strona logowania</h3>
        </div>

        <div class="main">
            <div class="aside" style="justify-content: flex-start; flex-direction: column; align-items: center; align-content: center;">
                <form class="form" method="POST">
                    <p>Login</p>
                    <input type="text" name="login">
                    <p>Hasło</p>
                    <input type="password" name="password">
                    <input type="submit" value="Zaloguj!">
                </form>
                <div style="display: flex; flex-direction: column; text-align: center; margin-top: 30px; font-weight: bolder; font-size: 20px;">
                    <p style="margin-bottom: 10px;">Nie masz konta?</p>
                    <a class='headerLink' href='/strona/sites/register.php'>Zarejestruj sie!</a>
                </div>
                <div style="display: flex; flex-direction: column; text-align: center; margin-top: 30px; font-size: 16px;">
                    <p style="margin-bottom: 2px;">Konto admina?</p>
                    <a class='headerLink' style='padding: 8px' href='/strona/sites/register.php'>Zaloguj jako admin</a>
                </div>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>