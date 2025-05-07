<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <?php
        if (isset($_POST['reason'])) {
            $reason = $_POST['reason'];
            if ($reason == "wrong_credencials")
            {
                echo "Złe dane logowania, spróbuj ponownie";
            }
            elseif($reason == "closed_session")
            {
                echo "Brak dostępu do strony. Zaloguj się aby kontynuować.";
            }
        }
    ?>

    <form method="post" action="z1.php">
    <label for="login">Login:</label><br>
        <input type="text" id="login" name="login" required><br><br>
        </br>
        <label for="pass">Hasło:</label><br>
        <input type="password" id="pass" name="pass" required><br><br>

        <input type="submit" name="log" value="Zaloguj">
    </form>

    
</body>
</html>