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
                <h1>Dostępne filmy</h1>
                <div style="height: 200px; overflow-y: scroll; display:flex; flex-wrap: wrap; flex-direction: row; justify-content: center; align-content: flex-start; border-bottom: 1px solid white">
                <?php
                    $con = new mysqli("localhost", "root", "", "movies");
                    $sql = "SELECT `id`, `name`, `year` FROM `movies` WHERE `renter_id` is null and `admin_id` is not null;";
                    $res = $con->query($sql);
                    while($row = $res->fetch_assoc()){
                        echo "
                        <a class='card' href='/strona/sites/movie-details.php?movieId=".$row["id"]."'>
                            <p>".$row["name"]."</p>
                            <p>".$row["year"]."r.</p>
                        </a>";
                    }
                ?>
                </div>
                <h1>Lub szukaj poprzez tytuł:</h1>
                <form method="POST">
                    <input type="text" name="title">
                    <input type="submit" value="Znajdz!">
                </form>
                <?php
                    if(isset($_POST["title"]) && !empty($_POST["title"])){
                        $sql = "SELECT `id`, `name`, `year` FROM `movies` WHERE `name` LIKE '%".$_POST["title"]."%' && `renter_id` is null and `admin_id` is not null;";
                        $res = $con->query($sql);
                        while($row = $res->fetch_assoc()){
                            echo "
                            <a class='card' href='/strona/sites/movie-details.php?movieId=".$row["id"]."'>
                                <p>".$row["name"]."</p>
                                <p>".$row["year"]."r.</p>
                            </a>";
                        }
                    }
                ?>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>