<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Użytkownika - Forum Grzybiarzy</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="panel.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <h1><a href="index.html">Forum Grzybiarzy</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html">Strona Główna</a></li>
                    <li><a href="#">Działy Forum</a></li>
                    <li><a href="#">Galerie Grzybów</a></li>
                    <li><a href="#">Wyszukiwarka</a></li>
                    <li><a href="#">Kontakt</a></li>
                </ul>
            </nav>
            <div class="user-status">
                <span>Witaj, **GrzybowyUser**!</span>
                <a href="user_panel.html">Mój Profil</a>
                <span>|</span>
                <a href="#">Wyloguj</a>
            </div>
        </div>
    </header>

    <div class="container user-panel-wrapper">
        <aside class="user-panel-sidebar">
            <h3>Panel Użytkownika</h3>
            <ul>
                <li><a href="#" class="active">Ustawienia profilu</a></li>
                <li><a href="#">Moje posty</a></li>
                <li><a href="#">Moje komentarze</a></li>
                <li><a href="#">Ulubione tematy</a></li>
                <li><a href="#">Zmień hasło</a></li>
                <li><a href="#">Powiadomienia</a></li>
            </ul>
        </aside>

        <main class="user-panel-content">
            <h2>Ustawienia Profilu</h2>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Nazwa użytkownika:</label>
                    <input type="text" id="username" name="username" value="GrzybowyUser" disabled>
                    <small style="color: var(--light-text-color); display: block; margin-top: 5px;">Nazwy użytkownika nie można zmienić.</small>
                </div>

                <div class="form-group">
                    <label for="email">Adres e-mail:</label>
                    <input type="email" id="email" name="email" value="grzybowy.user@example.com" required>
                </div>

                <div class="form-group">
                    <label for="location">Lokalizacja:</label>
                    <input type="text" id="location" name="location" value="Pruszcz Gdański, Polska">
                </div>

                <div class="form-group">
                    <label for="bio">O mnie:</label>
                    <textarea id="bio" name="bio" rows="4" placeholder="Opowiedz coś o sobie, swoich zainteresowaniach grzybowych...">Jestem zapalonym grzybiarzem z Pomorza, uwielbiam las i świeże powietrze. Szczególnie interesują mnie borowiki i rydze!</textarea>
                </div>

                <div class="form-group">
                    <label for="profile_picture">Zdjęcie profilowe:</label>
                    <div class="profile-picture-upload">
                        <div class="profile-picture-preview">
                            <img src="https://via.placeholder.com/120/8DBC86/FFFFFF?text=AV" alt="Zdjęcie profilowe użytkownika">
                            </div>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Zapisz zmiany</button>
                    <button type="reset" class="btn btn-secondary">Anuluj</button>
                </div>
            </form>
        </main>
    </div>

    <footer>
        <p>&copy; 2025 Forum Grzybiarzy. Wszelkie prawa zastrzeżone. | <a href="#">Polityka Prywatności</a> | <a href="#">Regulamin</a></p>
    </footer>

    <script>
        // Prosty skrypt do podglądu zdjęcia profilowego (opcjonalny, wymaga JS)
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('profile_picture');
            const imgPreview = document.querySelector('.profile-picture-preview img');

            if (fileInput && imgPreview) {
                fileInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imgPreview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imgPreview.src = "https://via.placeholder.com/120/8DBC86/FFFFFF?text=AV"; // Domyślny obraz
                    }
                });
            }
        });
    </script>
</body>
</html>