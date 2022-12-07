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
                <h1>Administratorzy</h1>
                <ul>
                <?php
                    $con = new mysqli("localhost", "root", "", "movies");
                    if(isset($_POST["futureAdminId"]) && !empty($_POST["futureAdminId"])){
                        $sql = "UPDATE `users` SET `is_admin`='1' WHERE `id` = '".$_POST["futureAdminId"]."';";
                        $con->query($sql);
                    }

                    $sql = "SELECT `id`, `login` FROM `users` WHERE `is_admin` = 1;";
                    $res = $con->query($sql);
                    while($row = $res->fetch_assoc()){
                        echo "<li>";
                        echo "<p>ID: ".$row["id"]." LOGIN: ".$row["login"]."</p>";
                        echo "</li>";
                    }
                ?>
                </ul>

                <h1>Użytkownicy</h1>
                <ul>
                <?php
                    $sql = "SELECT `id`, `login` FROM `users` WHERE `is_admin` = 0;";
                    $res = $con->query($sql);
                    while($row = $res->fetch_assoc()){
                        echo "<li>";
                        echo "<p style='margin-bottom: 8px;'>ID: ".$row["id"]." LOGIN: ".$row["login"]."</p>";
                        echo "<form method='POST' style='margin-top: 0px; margin-bottom: 24px;'>";
                        echo "<input type='hidden' name='futureAdminId' value='".$row["id"]."'>";
                        echo "<input type='submit' value='Nadaj admina'>";
                        echo "</form>";
                        echo "</li>";
                    }
                ?>
                </ul>
            </div>
        </div>

        <?php include $_SERVER['DOCUMENT_ROOT'].'/strona/includes/footer.php'; ?>
    </div>
</body>
</html>