<div class="header">
    <a href="/strona/index.php" style="text-decoration: none; color: white;"><h3>Strona z filmami!</h3></a>
    <a class='headerLink' href="/strona/sites/movie-search.php">Szuakj filmu!</a>
    <?php
    if(isset($_SESSION["id"])){
        $con = new mysqli("localhost", "root", "", "movies");
        $sql = "SELECT `login` FROM `users` WHERE `id`='".$_SESSION["id"]."';";
        $res = $con->query($sql);
        $row = $res->fetch_assoc();
        
        echo "<p>Zalogowano jako: ".($_SESSION["isAdmin"] ? "Administrator" : "Użytkownik")."</p>";
        echo "<p>Konto: ".($row["login"])."</p>";
        echo "<a class='headerLink' href='/strona/sites/logout.php'>Wyloguj!</a>";
    }
    else{
        echo "<a class='headerLink' href='/strona/sites/login.php'>Zaloguj sie!</a>";
        echo "<a class='headerLink' href='/strona/sites/register.php'>Zarejestruj sie!</a>";
    }
    ?>
</div>