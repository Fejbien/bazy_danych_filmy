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
                <a class="headerLink" href="/strona/sites/movie-search.php" style="margin-top: 20px;">Szukaj filmu</a>
                <div style="width: 100%; display:flex; flex-direction: column; align-items: center; font-size: 25px;">
                    <?php
                    if(!isset($_GET["movieId"])){
                        header("Location: ". "/strona/index.php");
                    }

                    $con = new mysqli("localhost", "root", "", "movies");
                    $sql = "SELECT m.id, m.name, m.year, m.length, g.genere, m.avaiable, u.login FROM movies as m JOIN generes as g ON g.id = m.genere_id JOIN users as u ON u.id = m.user_id WHERE m.id = '".$_GET["movieId"]."';";
                    $res = $con->query($sql);
                    while($row = $res->fetch_assoc()){
                        if($row["avaiable"] != 1){
                            echo "<h1>Film aktualnie nie dostępny!</h1>";
                        }
                        else{
                            echo "<h1 style='margin-top: 10px;'>Szczegóły filmu</h1>";
                            echo "<p>Tytuł: ".$row["name"]."</p>";
                            echo "<p>Rok: ".$row["year"]."</p>";
                            echo "<p>Długość: ".$row["length"]." (minuty)</p>";
                            echo "<p>Gatuenk: ".$row["genere"]."</p>";
                            echo "<p>Od użytkownika: ".$row["login"]."</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>