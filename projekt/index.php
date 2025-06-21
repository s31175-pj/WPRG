<?php
include 'php.php';

if (isset($_GET['logout'])) {
    session_destroy();
}

$query = "SELECT * FROM sections";
$sections = connect_db("localhost", "root", "", "shroomforum", $query);

$query = "SELECT COUNT(*) FROM sections";
$sections_temp = connect_db("localhost", "root", "", "shroomforum", $query);
$sections_row = mysqli_fetch_assoc($sections_temp);
$sections_size = $sections_row['COUNT(*)'];


if(session_status()==2)
{
    $query = "SELECT * FROM users WHERE login = $login OR email = $login";
    $result = connect_db("localhost", "root", "", "shroomforum", $query);
    $user = mysqli_fetch_row($result);
}




    
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Grzybiarzy - Strona Główna</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <h1><a href="">Forum Grzybiarzy</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="">Strona Główna</a></li>
                    <li><a href="">Działy Forum</a></li>
                    <li><a href="">Galerie Grzybów</a></li>
                    <li><a href="">Wyszukiwarka</a></li>
                    <li><a href="">Kontakt</a></li>
                </ul>
            </nav>
            <div class="user-status">
                    <?php
                        if(session_status()!=2) {
                            echo "<span>Witaj Gościu</span>";
                            echo "<a href='auth.php'>Zaloguj się</a>";
                            echo "<span>|</span>";
                            echo "<a href='auth.php'>Zarejestruj się</a>";
                        }
                        else 
                        {
                            echo "<span>Witaj $user[1]</span>";
                            echo "<a href='panel.php'>Mój Profil</a>";
                            echo "<span>|</span>";
                            echo "<a href='index.php?logout=true'>Wyloguj</a>";
                        }
                    ?>
            </div>
        </div>
    </header>

    <div class="container">
        <section class="forum-sections">
            <?php
            
                for($i = 0; $i<$sections_size; $i++)
                {
                    $section = mysqli_fetch_row($sections);

                    $query = "SELECT * FROM topics WHERE section_id=$section[0]";
                    $topic = connect_db("localhost", "root", "", "shroomforum", $query);

                    $query = "SELECT * FROM users WHERE id=$topic[1]";
                    $topic_user = connect_db("localhost", "root", "", "shroomforum", $query);

                    $query = "SELECT COUNT(*) FROM comments WHERE topic_id=$topic[0]";
                    $comments_temp = connect_db("localhost", "root", "", "shroomforum", $query);
                    $comments_row = mysqli_fetch_assoc($sections_temp);
                    $comments_size = $comments_row['COUNT(*)'];

                    if($comments_size>0)
                    {
                        $query = "SELECT * FROM comments WHERE id=$topic[1] ORDER BY date DESC";
                        $last_comments = connect_db("localhost", "root", "", "shroomforum", $query);
                        $last_comment = mysqli_fetch_row($last_comments)[4];
                    }
                    else
                    {
                        $last_comment = $topic[3];
                    }

                    echo '<article class="section-card">';
                    echo    '<div class="section-header">';
                    echo        "<h2><a href=''>$section[1]</a></h2>";
                    echo        "<a href='category.php/?section='".$section[0].">Zobacz wszystkie</a>";
                    echo    '</div>';
                    echo    '<div class="section-content">';
                    echo        '<div class="latest-topic">';
                    echo            '<h3><a href="topic.php/?id='.$topic[0].'">'.$topic[1].'</a></h3>';
                    echo            "<p class='topic-meta'>Autor: $topic_user[1] | Data: $topic[3] | Komentarze: $comments_size</p>";
                    echo            "<p class='topic-excerpt'>$topic[5]</p>";
                    echo            '<div class="topic-footer">';
                    echo                "<span>Ostatni post: $last_comment</span>";
                    echo                '<a href="topic.php/?id='.$topic[0].'">Przejdź do tematu</a>';
                    echo            "</div>";
                    echo        '</div>';
                    echo    '</div>';
                    echo '</article>';
                } 
            ?>
            <article class="section-card">
                <div class="section-header">
                    <h2><a href="#">Identyfikacja Grzybów</a></h2>
                    <a href="#">Zobacz wszystkie</a>
                </div>
                <div class="section-content">
                    <div class="latest-topic">
                        <h3><a href="#">Co to za grzyb? Zdjęcia z lasu</a></h3>
                        <p class="topic-meta">Autor: GrzybowyNowicjusz | Data: 15.06.2025 | Komentarze: 8</p>
                        <p class="topic-excerpt">Znalazłem dzisiaj dziwny grzyb. Kapelusz jasnobrązowy, od spodu blaszki białe. Trzon cienki, bez pierścienia...</p>
                        <div class="topic-footer">
                            <span>Ostatni post: 15.06.2025, 14:30</span>
                            <a href="#">Przejdź do tematu</a>
                        </div>
                    </div>
                </div>
            </article>

            <article class="section-card">
                <div class="section-header">
                    <h2><a href="#">Miejsca Grzybobrania</a></h2>
                    <a href="#">Zobacz wszystkie</a>
                </div>
                <div class="section-content">
                    <div class="latest-topic">
                        <h3><a href="#">Grzybobranie w Puszczy Białowieskiej - udane!</a></h3>
                        <p class="topic-meta">Autor: LeśnyWłóczęga | Data: 12.06.2025 | Komentarze: 15</p>
                        <p class="topic-excerpt">Wczorajsze wyjście do lasu okazało się strzałem w dziesiątkę! Koszyk pełen prawdziwków i koźlarzy...</p>
                        <div class="topic-footer">
                            <span>Ostatni post: 13.06.2025, 09:10</span>
                            <a href="#">Przejdź do tematu</a>
                        </div>
                    </div>
                </div>
            </article>

            <article class="section-card">
                <div class="section-header">
                    <h2><a href="#">Przepisy z Grzybów</a></h2>
                    <a href="#">Zobacz wszystkie</a>
                </div>
                <div class="section-content">
                    <div class="latest-topic">
                        <h3><a href="#">Pyszny sos borowikowy - mój przepis!</a></h3>
                        <p class="topic-meta">Autor: KulinarnyGrzybiarz | Data: 08.06.2025 | Komentarze: 22</p>
                        <p class="topic-excerpt">Dzielę się sprawdzonym przepisem na sos borowikowy, który idealnie pasuje do makaronu i mięs...</p>
                        <div class="topic-footer">
                            <span>Ostatni post: 10.06.2025, 18:45</span>
                            <a href="#">Przejdź do tematu</a>
                        </div>
                    </div>
                </div>
            </article>

            <article class="section-card">
                <div class="section-header">
                    <h2><a href="#">Suszenie i Przechowywanie</a></h2>
                    <a href="#">Zobacz wszystkie</a>
                </div>
                <div class="section-content">
                    <div class="latest-topic">
                        <h3><a href="#">Szybkie sposoby na suszenie grzybów</a></h3>
                        <p class="topic-meta">Autor: GospodarzLasu | Data: 05.06.2025 | Komentarze: 11</p>
                        <p class="topic-excerpt">Zbliża się sezon, więc warto przypomnieć sobie najlepsze metody suszenia grzybów. Ja polecam suszarki...</p>
                        <div class="topic-footer">
                            <span>Ostatni post: 07.06.2025, 11:00</span>
                            <a href="#">Przejdź do tematu</a>
                        </div>
                    </div>
                </div>
            </article>

        </section>
    </div>

    <footer>
        <p>&copy; 2025 Forum Grzybiarzy. Wszelkie prawa zastrzeżone. | <a href="#">Polityka Prywatności</a> | <a href="#">Regulamin</a></p>
    </footer>
</body>
</html>