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
        if(isset($_POST["loginRegistration"]) && isset($_POST["passwordRegistration"])){
            $con = new mysqli("localhost", "root", "", "movies");
            $sql = "INSERT INTO `users` (`id`, `login`, `password`, `is_admin`) VALUES (NULL, '".$_POST["loginRegistration"]."', '".$_POST["passwordRegistration"]."', '0');";
            $con->query($sql);
            $con->close();
            header("Location: ". "/strona/sites/login.php");
        }
        ?>
        <div class="header">
            <h3>Strona rejestracji</h3>
        </div>

        <div class="main" style="justify-content: flex-start; flex-direction: column">
            <div class="aside" style="justify-content: flex-start; flex-direction: column; align-items: center;  align-content: center;">
                <form class="form" method="POST">
                    <p>Login</p>
                    <input type="text" name="loginRegistration">
                    <p>Hasło</p>
                    <input type="password" name="passwordRegistration">
                    <input type="submit" value="Zarejestruj!">
                </form>
                <div style="display: flex; flex-direction: column; text-align: center; margin-top: 30px; font-weight: bolder; font-size: 20px;">
                    <p style="margin-bottom: 10px;">Masz już konto?</p>
                    <a class='headerLink' href='/strona/sites/login.php'>Zaloguj sie!</a>
                </div>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>