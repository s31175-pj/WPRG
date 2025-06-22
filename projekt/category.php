<?php
include 'php.php';
include 'session_util.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoria: Identyfikacja Grzybów - Forum Grzybiarzy</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="category.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <h1><a href="index.php">Forum Grzybiarzy</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Strona Główna</a></li>
                    <li><a href="#">Działy Forum</a></li>
                    <li><a href="#">Galerie Grzybów</a></li>
                    <li><a href="#">Wyszukiwarka</a></li>
                    <li><a href="#">Kontakt</a></li>
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
        <section class="category-header">
            <h2>Kategoria: <?php 
                $stmt = $conn->prepare("SELECT * FROM sections WHERE id = ?");
                $stmt->bind_param("i", $_GET['section']);
                $stmt->execute();
                $sections = $stmt->get_result()->fetch_row();
                echo $sections[1];
            ?></h2>
        </section>

        
        <section class="topic-list">
            <?php
                $stmt = $conn->prepare("SELECT * FROM topics WHERE section_id=?");
                $stmt->bind_param("i", $sections[0]);
                $stmt->execute();
                $topics_size = $stmt->get_result()->num_rows;

                for($i = 0; $i<$topics_size; $i++)
                {
                    $stmt = $conn->prepare("SELECT * FROM topics WHERE section_id=?");
                    $stmt->bind_param("i", $sections[0]);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    for($j = 0; $j<=$i; $j++)
                    {
                        $topic = $result->fetch_row();
                    }

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

                        $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
                        $stmt->bind_param("i", $last_comments[1]);
                        $stmt->execute();
                        $comment_user = $stmt->get_result()->fetch_row();
                    }
                    else
                    {
                        $last_comment = $topic[3];
                    }

                    echo '<article class="topic-card">';
                    echo    '<div class="topic-card-header">';
                    echo        "<h3>$topic[4]</h3>";
                    echo        '<p class="topic-meta-full">';
                    echo            "<span>Autor: $topic_user[1]</span>";
                    echo            "<span>Data: $topic[3]</span>";
                    echo            "<span>Odpowiedzi: $comments_size</span>"; 
                    echo        '</p>';
                    echo    '</div>';
                    echo    '<p class="topic-excerpt">';
                    echo        "$topic[5]";
                    echo    '</p>';
                    echo    '<div class="topic-card-footer">';
                    if($comments_size>0) echo "<span>Ostatni post: $last_comment przez $comment_user[1]</span>";
                    echo        '<a href="topic.php?id='.$topic[0].'">Czytaj temat</a>';
                    echo    '</div>';
                    echo '</article>';
                } 
            ?>
            <div class="text-center" style="margin-top: 20px;">
                <button class="btn" style="background-color: var(--accent-color); color: var(--text-color);">Pokaż więcej tematów</button>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Forum Grzybiarzy. Wszelkie prawa zastrzeżone. | <a href="#">Polityka Prywatności</a> | <a href="#">Regulamin</a></p>
    </footer>
</body>
</html>