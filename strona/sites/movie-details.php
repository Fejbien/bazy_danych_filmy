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
                    if(isset($_POST["idToRent"]) && !empty($_POST["idToRent"])){
                        $sql = "UPDATE `movies` SET `renter_id`= '".$_SESSION["id"]."' WHERE `id`='".$_POST["idToRent"]."';";
                        $con->query($sql);
                    }

                    if(isset($_POST["idToReturn"]) && !empty($_POST["idToReturn"])){
                        $sql = "UPDATE `movies` SET `renter_id` = NULL WHERE `id`=".$_POST["idToReturn"].";";
                        $con->query($sql);
                    }

                    $sql = "SELECT m.user_id, m.id, m.name, m.year, m.length, g.genere, m.renter_id, u.login, a.login as 'admin', m.user_id as 'id' FROM movies as m JOIN generes as g ON g.id = m.genere_id JOIN users as u ON u.id = m.user_id LEFT JOIN users as a ON a.id = m.admin_id WHERE m.id = '".$_GET["movieId"]."';";
                    $res = $con->query($sql);
                    while($row = $res->fetch_assoc()){
                        if($row["renter_id"] != NULL && $row["user_id"] != $_SESSION["id"] && $row["renter_id"] != $_SESSION["id"]){
                            echo "<h1>Film aktualnie nie dost??pny!<br>Wypo??yczony</h1>";
                        }
                        else{
                            if($row["admin"] == NULL && $row["id"] != $_SESSION["id"]){
                                echo "<h1>Film jeszcze nie zatwierdzony!</h1>";
                            }
                            else{
                                if($row["admin"] != NULL) 
                                    echo "<p style='color: green;'>Zatwierdzony</p>";
                                else 
                                    echo "<p style='color: red;'>Nie zatwierdzony</p>";

                                echo "<h1 style='margin-top: 10px;'>Szczeg????y filmu</h1>";
                                echo "<p>Tytu??: ".$row["name"]."</p>";
                                echo "<p>Rok: ".$row["year"]."</p>";
                                echo "<p>D??ugo????: ".$row["length"]." (minuty)</p>";
                                echo "<p>Gatuenk: ".$row["genere"]."</p>";
                                echo "<p>Od u??ytkownika: ".$row["login"]."</p>";
                                echo $row["renter_id"] == NULL ? "<p style='color: green;'>Nie wypo??yczony</p>" : "<p style='color: red;'>Wypo??yczony</p>";

                                if($row["renter_id"] == NULL && $row["admin"] != NULL){
                                    echo "<form method='POST'>";
                                    echo "<input type='hidden' name='idToRent' value='".$_GET["movieId"]."'>";
                                    echo "<input type='submit' value='Wypo??ycz'>";
                                    echo "</form>";
                                }

                                if($row["renter_id"] == $_SESSION["id"] && $row["admin"] != NULL){
                                    echo "<form method='POST'>";
                                    echo "<input type='hidden' name='idToReturn' value='".$_GET["movieId"]."'>";
                                    echo "<input type='submit' value='Oddaj'>";
                                    echo "</form>";
                                }
                            }
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