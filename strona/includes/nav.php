<div class="nav">
    <h3>Menu</h3>
    <ul>
        <li><a href="/strona/index.php">Strona główna</a></li>
        <li><a href="/strona/sites/movie-search.php">Szukaj filmu</a></li>
    </ul>
    <hr>
    <?php
    if(isset($_SESSION["id"])){
        echo "<ul>";
        echo "<li><a href='/strona/sites/movie-my.php'>Moje filmy</a></li>";
        echo "<li><a href='/strona/sites/movie-add.php'>Dodaj film</a></li>";
        echo "</ul>";
        echo "<hr>";
        if($_SESSION["isAdmin"])
        {
            echo "<ul>";
            echo "<li><a href='/strona/admin/movie-list.php'>Wszystkie filmy</a></li>";
            echo "<li><a href='/strona/admin/add-admin.php'>Nadaj admina</a></li>";
            echo "</ul>";
            echo "<hr>";
        }
    }
    else{
        echo "<div style='text-align: center; display: flex; flex-direction: column'>";
        echo "<p><b>Nie jesteś zalogowany!</b></p>";
        echo "<a class='headerLink' href='/strona/sites/login.php'>Zaloguj sie!</a>";
        echo "<p style='margin-top: 40px;'><b>Nie masz konta?</b></p>";
        echo "<a class='headerLink' href='/strona/sites/register.php'>Zarejestruj sie!</a>";
        echo "</div>";
    }
    ?>
</div>