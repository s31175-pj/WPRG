<?php
if (isset($_POST['usun_ciasteczka'])) {
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, '', time() - 3600, '/');
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['usun_ciasteczka'])) {
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            setcookie($key, serialize($value), time() + (86400 * 30), "/");
        } else {
            setcookie($key, $value, time() + (86400 * 30), "/");
        }
    }
}

    if (isset($_POST['login']))
    {
        $login = $_POST["login"];
        $pass = $_POST["pass"];
        $_COOKIE['login'] = $login;

        if($login == 'admin' && $pass == 'admin')
        {
            session_start();
        }
        else
        {
            $url_docelowy = 'login.php';

            echo '<form id="przekierowanie" method="post" action="' . htmlspecialchars($url_docelowy) . '">';
                echo '<input type="hidden" name="reason" value="wrong_credencials">';
            echo '</form>';
            echo '<script>document.getElementById("przekierowanie").submit();</script>';
            exit();
        }
    }

    if (session_status()!=2)
    {
        $url_docelowy = 'login.php';

            echo '<form id="przekierowanie" method="post" action="' . htmlspecialchars($url_docelowy) . '">';
                echo '<input type="hidden" name="reason" value="closed_session">';
            echo '</form>';
            echo '<script>document.getElementById("przekierowanie").submit();</script>';
            exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz Rezerwacji Hotelu</title>
</head>
<body>
    <?php
        echo "Witaj ";
        echo $_COOKIE['login'];
    ?>
    <form method="post" action="login.php">
    <input type="submit" name="" value="Wyloguj">
    </form>

    <h1>Formularz Rezerwacji Hotelu</h1>
    <form method="post" action="z1.1.php">
        <label for="liczba_osob">Liczba osób (1-4):</label><br>
        <select id="liczba_osob" name="liczba_osob">
            <option value="1" <?php if (isset($_COOKIE['liczba_osob']) && $_COOKIE['liczba_osob'] == '1') echo 'selected'; ?>>1</option>
            <option value="2" <?php if (isset($_COOKIE['liczba_osob']) && $_COOKIE['liczba_osob'] == '2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if (isset($_COOKIE['liczba_osob']) && $_COOKIE['liczba_osob'] == '3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if (isset($_COOKIE['liczba_osob']) && $_COOKIE['liczba_osob'] == '4') echo 'selected'; ?>>4</option>
        </select><br><br>

        <label for="imie">Imię*:</label><br>
        <input type="text" id="imie" name="imie" value="<?php if (isset($_COOKIE['imie'])) echo $_COOKIE['imie']; ?>" required><br><br>

        <label for="nazwisko">Nazwisko*:</label><br>
        <input type="text" id="nazwisko" name="nazwisko" value="<?php if (isset($_COOKIE['nazwisko'])) echo $_COOKIE['nazwisko']; ?>" required><br><br>

        <label for="adres">Adres*:</label><br>
        <textarea id="adres" name="adres" required><?php if (isset($_COOKIE['adres'])) echo $_COOKIE['adres']; ?></textarea><br><br>

        <label for="karta_kredytowa">Numer karty kredytowej*:</label><br>
        <input type="text" id="karta_kredytowa" name="karta_kredytowa" value="<?php if (isset($_COOKIE['karta_kredytowa'])) echo $_COOKIE['karta_kredytowa']; ?>" required><br><br>

        <label for="email">E-mail*:</label><br>
        <input type="email" id="email" name="email" value="<?php if (isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>" required><br><br>

        <label for="data_pobytu">Data pobytu*:</label><br>
        <input type="date" id="data_pobytu" name="data_pobytu" value="<?php if (isset($_COOKIE['data_pobytu'])) echo $_COOKIE['data_pobytu']; ?>" required><br><br>

        <label for="godzina_przyjazdu">Godzina przyjazdu:</label><br>
        <input type="time" id="godzina_przyjazdu" name="godzina_przyjazdu" value="<?php if (isset($_COOKIE['godzina_przyjazdu'])) echo $_COOKIE['godzina_przyjazdu']; ?>"><br><br>

        <label for="lozko_dziecko">Łóżko dla dziecka:</label>
        <input type="checkbox" id="lozko_dziecko" name="lozko_dziecko" <?php if (isset($_COOKIE['lozko_dziecko']) && $_COOKIE['lozko_dziecko'] == 'on') echo 'checked'; ?>><br><br>

        <label for="udogodnienia">Udogodnienia:</label><br>
        <select id="udogodnienia" name="udogodnienia[]" multiple>
            <?php
            if (isset($_COOKIE['udogodnienia'])) {
                $udogodnienia_z_cookie = unserialize($_COOKIE['udogodnienia']);
            } else {
                $udogodnienia_z_cookie = [];
            }
            ?>
            <option value="Klimatyzacja" <?php if (in_array('Klimatyzacja', $udogodnienia_z_cookie)) echo 'selected'; ?>>Klimatyzacja</option>
            <option value="Popielniczka" <?php if (in_array('Popielniczka', $udogodnienia_z_cookie)) echo 'selected'; ?>>Popielniczka dla palących</option>
            <option value="wi-fi" <?php if (in_array('wi-fi', $udogodnienia_z_cookie)) echo 'selected'; ?>>Wi-Fi</option>
            <option value="parking" <?php if (in_array('parking', $udogodnienia_z_cookie)) echo 'selected'; ?>>Parking</option>
        </select><br><br>

        <input type="submit" value="Rezerwuj">
    </form>

    <form method="post" action="z1.php">
    <input type="submit" name="usun_ciasteczka" value="Wyczyść dane formularza">
    </form>

    
</body>
</html>