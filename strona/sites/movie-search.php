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
                <h1 style="width: 100%; text-align: center;">Dostępne filmy</h1>
                <?php
                    $con = new mysqli("localhost", "root", "", "movies");
                    $sql = "SELECT `id`, `name`, `year` FROM `movies` WHERE `avaiable` = 1;";
                    $res = $con->query($sql);
                    while($row = $res->fetch_assoc()){
                        echo "
                        <a class='cardLink' href='/strona/sites/movie-details.php?movieId=".$row["id"]."'>
                            <p>".$row["name"]."</p>
                            <p>".$row["year"]."r.</p>
                        </a>";
                    }
                ?>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>