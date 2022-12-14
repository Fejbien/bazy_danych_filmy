<?php session_start(); 
    if(!isset($_SESSION["id"])){
        header("Location: ". "/strona/index.php");
    }
?>
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
                <h1>Twoje filmy</h1>
                <?php
                    $con = new mysqli("localhost", "root", "", "movies");
                    $sql = "SELECT `id`, `name`, `year`, `admin_id` FROM `movies` WHERE `user_id` = '".$_SESSION["id"]."';";
                    $res = $con->query($sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = $res->fetch_assoc()){
                            echo "<a class='card' href='/strona/sites/movie-details.php?movieId=".$row["id"]."'>";
                            echo "<p>".$row["name"]."</p>";
                            echo "<p>".$row["year"]."r.</p>";
                            echo $row["admin_id"] != null ? "<p style='color: green;'>Zatwierdzony</p>" : "<p style='color: red'>Niezatwierdzony</p>";
                            echo "</a>";
                        }
                    }
                    else{
                        echo "<div style='display: flex; flex-direction: column; align-content: center; justify-content: center; align-items: center;'>";
                        echo "<h2>Nie dodałeś jeszcze żadnego filmu!</h2>";
                        echo "<a class='headerLink' href='/strona/sites/movie-add.php'>Dodaj film!</a>";
                        echo "</div>";
                    }
                ?>

                <h1>Wypożyczane</h1>
                <?php
                    $sql = "SELECT `id`, `name`, `year` FROM `movies` WHERE `renter_id` = '".$_SESSION["id"]."';";
                    $res = $con->query($sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = $res->fetch_assoc()){
                            echo "<a class='card' href='/strona/sites/movie-details.php?movieId=".$row["id"]."'>";
                            echo "<p>".$row["name"]."</p>";
                            echo "<p>".$row["year"]."r.</p>";
                            echo "</a>";
                        }
                    }
                    else{
                        echo "<div style='display: flex; flex-direction: column; align-content: center; justify-content: center; align-items: center;'>";
                        echo "<h2>Nie wypożyczasz jeszcze żadnego filmu!</h2>";
                        echo "<a class='headerLink' href='/strona/sites/movie-search.php'>Szukaj film!</a>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>