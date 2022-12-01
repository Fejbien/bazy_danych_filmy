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
        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/header.php';?>

        <div class="main">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/nav.php'; ?>
            <div class="aside">
                <?php
                if(!isset($_GET["movieId"])){
                    header("Location: ". "/strona/index.php");
                }

                $con = new mysqli("localhost", "root", "", "movies");
                $sql = "";
                $res = $con->query($sql);
                while($row = $res->fetch_assoc()){

                }
                ?>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>