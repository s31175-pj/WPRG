<?php
include 'php.php';
include 'session_util.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(session_status()==2)
    {
        $stmt = $conn->prepare("INSERT INTO comments (user_id, topic_id, content, photo_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user[0], $_GET['id'], $_POST['comment_content']);
    }
    
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temat: Co to za grzyb? Zdjęcia z lasu - Forum Grzybiarzy</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="topic.css">
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
                    <li><a href="index.php">Działy Forum</a></li>
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

    <?php

        $stmt = $conn->prepare("SELECT * FROM topics WHERE id = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $topic = $stmt->get_result()->fetch_row();

        $stmt = $conn->prepare("SELECT * FROM sections WHERE id = ?");
        $stmt->bind_param("i", $topic[2]);
        $stmt->execute();
        $section = $stmt->get_result()->fetch_row();

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $topic[1]);
        $stmt->execute();
        $author = $stmt->get_result()->fetch_row();

    echo '<div class="container">';
    echo    '<div class="breadcrumbs">';
    echo        '<a href="index.php">Strona Główna</a> <span>&gt;</span>';
    echo        '<a href="category.php?section='.$section[0].'">'.$section[1].'</a> <span>&gt;</span>';
    echo        "<span>$topic[4]</span>";
    echo    "</div>";

    echo    '<article class="topic-post card">';
    echo        '<h1 class="topic-title">'.$topic[4].'</h1>';
    echo        '<p class="topic-meta">';
    echo            "<span>Autor: <strong>$author[1]</strong></span>";
    echo            "<span>Data: $topic[3]</span>";
    echo            '<span>W dziale: <a href="category.php?section='.$section[0].'">'.$section[1].'</a></span>';
    echo        "</p>";
    echo        '<div class="topic-content">';
    echo            "<p>$topic[5]</p>";
    echo        "</div>";
    echo        '<div class="post-footer">';
    echo            '<div class="actions">';
    echo                '<a href="#">Edytuj</a>';
    echo                '<a href="#">Usuń</a>';
    echo                '<a href="#">Zgłoś</a>';
    echo            "</div>";
    echo        "</div>";
    echo    "</article>";

        $stmt = $conn->prepare("SELECT * FROM comments WHERE topic_id = ?");
        $stmt->bind_param("i", $topic[0]);
        $stmt->execute();
        $comments_size = $stmt->get_result()->num_rows;


    echo    '<section class="comments-section">';
    echo        "<h2>Komentarze ($comments_size)</h2>";

    for ($i = 0; $i<$comments_size; $i++)
    {

        $stmt = $conn->prepare("SELECT * FROM comments WHERE topic_id=?");
        $stmt->bind_param("i", $topic[0]);
        $stmt->execute();
        $result = $stmt->get_result();
        for($j = 0; $j<=$i; $j++)
        {
            $comment = $result->fetch_row();
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("i", $comment[1]);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_row();

        if($comment[3]==null) echo        '<article class="comment-card card">';
        else echo '<article class="comment-card card reply">';
        echo            '<div class="comment-header">';
        echo                '<div class="comment-author-avatar">';
        echo                    '<img src="https://via.placeholder.com/50/F7B844/333333?text=MK" alt="Awatar Marka">';
        echo                "</div>";
        echo                '<div class="comment-info">';
        echo                    '<a href="#" class="comment-author">'.$user[5].'</a>';
        echo                    '<span class="comment-date">'.$comment[4].'</span>';
        echo                "</div>";
        echo            "</div>";
        echo            '<div class="comment-content">';
        echo                "<p>$comment[5]</p>";
        echo            "</div>";
        echo            '<div class="comment-actions">';
        echo                '<a href="#">Odpowiedz</a>';
        echo                '<a href="#">Zgłoś</a>';
        echo           "</div>";
        echo        "</article>";
    }

    
            ?>

        </section>

        <section class="add-comment-form card">
            <h3>Dodaj Komentarz</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="comment-content">Twój komentarz:</label>
                    <textarea id="comment-content" name="comment_content" required placeholder="Wpisz swój komentarz..."></textarea>
                </div>
                <div class="form-group">
                    <label for="comment-photo">Dodaj zdjęcie (opcjonalnie):</label>
                    <input type="file" id="comment-photo" name="comment_photo" accept="image/*">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn">Wyślij Komentarz</button>
                </div>
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Forum Grzybiarzy. Wszelkie prawa zastrzeżone. | <a href="#">Polityka Prywatności</a> | <a href="#">Regulamin</a></p>
    </footer>
</body>
</html>