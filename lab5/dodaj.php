<?php


// if(!mysqli_close($db_lnk))
// {
//     echo 'Wystąpił błąd podczas zamykania połączenia z serwerem MySQL<br/>';
// }
// else
// {
//     echo 'Połączenie z serwerem MySQL zostało zamknięte...<br/>';
// }

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!$db_lnk = mysqli_connect("localhost", "root", ""))
    {
        exit('Nie udało się połączyć z serwerem MySQL...<br/>');
    }

    if(!mysqli_select_db($db_lnk, 'mojaBaza'))
    {
        echo 'Nie udało się wybrać bazy: mojaBaza<br/>';
    }

    $marka = $_POST["marka"];
    $model = $_POST["model"];
    $cena = $_POST["cena"];
    $rocznik = $_POST["rocznik"];
    $opis = $_POST["opis"];

    $query = "INSERT INTO samochody (marka, model, cena, rok, opis)";
    $query .= "VALUES ('$marka', '$model', '$cena', '$rocznik', '$opis')";

    if(!$result = mysqli_query($db_lnk, $query))
    {
        mysqli_close($db_lnk);
        echo 'Nieprawidłowe zapytanie';
        exit;
    }
    else
    {
        $rows = mysqli_affected_rows($db_lnk);
        mysqli_close($db_lnk);

        echo "Poprawnie dodano samochód marki: $marka do bazy. Liczba dodanych rekordów: $rows";
    }
}
    
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Samochodowy - Dodaj samochód</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-panel">
        <ul>
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="wszystkie.php">Wszystkie samochody</a></li>
            <li><a href="dodaj.php">Dodaj samochód</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Dodaj samochód</h2>
        <form action="" method="post">
            <label for="marka">Marka:</label>
            <input type="text" id="marka" name="marka" required><br>
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required><br>
            <label for="cena">Cena:</label>
            <input type="number" id="cena" name="cena" required><br>
            <label for="rocznik">Rocznik:</label>
            <input type="number" id="rocznik" name="rocznik" required><br>
            <label for="opis">Opis:</label>
            <input type="text" id="opis" name="opis" required><br>

            <input type="submit" value="Dodaj">
        </form>
    </div>
</body>
</html>