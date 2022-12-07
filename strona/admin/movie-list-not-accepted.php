<?php 
session_start();
if(!$_SESSION["isAdmin"]){
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
                <h1>Filmy</h1>
                <?php
                    $con = new mysqli("localhost", "root", "", "movies");
                    $sql = "SELECT `id`, `name`, `year`, `admin_id` FROM `movies` WHERE `admin_id` is null;";
                    $res = $con->query($sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = $res->fetch_assoc()){
                            echo "<a class='card' href='/strona/admin/movie-details.php?movieId=".$row["id"]."'>";
                            echo "<p>".$row["name"]."</p>";
                            echo "<p>".$row["year"]."r.</p>";
                            echo $row["admin_id"] != null ? "<p style='color: green;'>Zatwierdzony</p>" : "<p style='color: red'>Niezatwierdzony</p>";
                            echo "</a>";
                        }
                    }
                    else{
                        echo "<h1>Wszystkie filmy w serwisie są zaakceptowane!</h1>";
                    }
                ?>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>