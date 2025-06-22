<?php
include 'php.php';
include 'session_util.php';


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
                    <li><a href="index.php">Strona Główna</a></li>
                    <li><a href="index.php">Działy Forum</a></li>
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

                $stmt = $conn->prepare("SELECT * FROM sections");
                $stmt->execute();
                $sections_size = $stmt->get_result()->num_rows;

                for($i = 0; $i<$sections_size; $i++)
                {
                    $stmt = $conn->prepare("SELECT * FROM sections");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    for($j = 0; $j<=$i; $j++)
                    {
                        $section = $result->fetch_row();
                    }

                    $stmt = $conn->prepare("SELECT * FROM topics WHERE section_id=?");
                    $stmt->bind_param("i", $section[0]);
                    $stmt->execute();
                    $topic = $stmt->get_result()->fetch_row();

                    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
                    $stmt->bind_param("i", $topic[1]);
                    $stmt->execute();
                    $topic_user = $stmt->get_result()->fetch_row();

                    $stmt = $conn->prepare("SELECT * FROM comments WHERE topic_id=?");
                    $stmt->bind_param("i", $topic[0]);
                    $stmt->execute();
                    $comments_size = $stmt->get_result()->num_rows;

                    if($comments_size>0)
                    {

                        $stmt = $conn->prepare("SELECT * FROM comments WHERE id=? ORDER BY date DESC");
                        $stmt->bind_param("i", $topic[1]);
                        $stmt->execute();
                        $last_comments = $stmt->get_result()->fetch_row();
                        $last_comment = $last_comments[4];
                    }
                    else
                    {
                        $last_comment = $topic[3];
                    }

                    echo '<article class="section-card">';
                    echo    '<div class="section-header">';
                    echo        "<h2>$section[1]</h2>";
                    echo        "<a href='category.php?section=".$section[0]."'>Zobacz wszystkie</a>";
                    echo    '</div>';
                    echo    '<div class="section-content">';
                    echo        '<div class="latest-topic">';
                    echo            '<h3>'.$topic[4].'</h3>';
                    echo            "<p class='topic-meta'>Autor: $topic_user[1] | Data: $topic[3] | Komentarze: $comments_size</p>";
                    echo            "<p class='topic-excerpt'>$topic[5]</p>";
                    echo            '<div class="topic-footer">';
                    echo                "<span>Ostatni post: $last_comment</span>";
                    echo                '<a href="topic.php?id='.$topic[0].'">Przejdź do tematu</a>';
                    echo            "</div>";
                    echo        '</div>';
                    echo    '</div>';
                    echo '</article>';
                } 
            ?>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Forum Grzybiarzy. Wszelkie prawa zastrzeżone. | <a href="#">Polityka Prywatności</a> | <a href="#">Regulamin</a></p>
    </footer>
</body>
</html>