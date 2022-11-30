<div class="header">
    <h3>Strona z filmami!</h3>
    <a href="./sites/movie-search.php">Szuakj filmu!</a>
    <?php
    if(isset($_COOKIE["id"])){
        echo "<p>Zalogowano jako: ".$_row["login"]."</p>";
        echo "<a href='./sites/logout.php'>Wyloguj!</a>";
    }
    else{
        echo "<a href='./sites/login.php'>Zaloguj sie!</a>";
    }
    ?>
</div>