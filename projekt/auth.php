<?php

    include 'php.php';

    if (session_status()==2) redirect('index.php');

    $conn = new mysqli("localhost", "root", "", "shroomforum");

    if (isset($_POST["login"]))
    {

        $login = $_POST["login"];
        $pass = $_POST["pass"];

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $login, $login);
        
        $stmt->execute();
        $user = $stmt->get_result()->fetch_row();

        if(!(($user[1] == $login || $user[2] == $login) && password_verify($pass, $user[3])))
        {
            $conn->close();
            echo 'Niepoprawny login lub hasło';
        }
        else
        {
            session_start();
            $_SESSION["login"] = $login;
            $_SESSION["login_true"] = true;
            $conn->close();

            echo '<form id="przekierowanie" method="post" action="index.php">';
            echo '<input type="hidden" name="login_true" value="session_active">';
            echo '</form>';
            echo '<script>document.getElementById("przekierowanie").submit();</script>';
            exit();
        }
    }
    else if (isset($_POST["username"]))
    {
        
        $username = $_POST["username"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "Niepoprawny email";
        }
        else
        {
            $stmt = $conn->prepare("INSERT INTO users (username, email, hashed_password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashpass);
            
            $stmt->execute();
        }
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie i Rejestracja - Forum Grzybiarzy</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <h2>Logowanie</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="login-username">Nazwa użytkownika / E-mail</label>
                    <input type="text" id="login-username" name="login" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Hasło</label>
                    <input type="password" id="login-password" name="pass" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn">Zaloguj się</button>
                </div>
                <p class="text-center">
                    <a href="#">Zapomniałeś hasła?</a>
                </p>
            </form>
        </div>

        <div class="auth-card" id="register-form-section">
            <h2>Rejestracja</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="register-username">Nazwa użytkownika</label>
                    <input type="text" id="register-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="register-email">E-mail</label>
                    <input type="email" id="register-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Hasło</label>
                    <input type="password" id="register-password" name="pass"  onkeyup='check();' required>
                </div>
                <div class="form-group">
                    <label for="register-confirm-password">Potwierdź hasło</label>
                    <input type="password" id="register-confirm-password" name="pass2"  onkeyup='check();' required>
                    <span id='message' style='color:red;'></span>
                </div>
                <div class="form-actions">
                    <button type="submit" id="register_button" class="btn">Zarejestruj się</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        var check = function() {
            if (document.getElementById('register-password').value == document.getElementById('register-confirm-password').value)
            {
                document.getElementById('message').innerHTML = '';
                document.getElementById('register_button').disabled = false;
            } else {
                document.getElementById('message').innerHTML = 'Hasła nie są zgodne';
                document.getElementById('register_button').disabled = true;
            }
        }
    </script>
</body>
</html>