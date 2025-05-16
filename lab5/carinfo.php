<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $id = $_POST["id"];
        if (!$db_lnk = mysqli_connect("localhost", "root", ""))
        {
            exit('Nie udało się połączyć z serwerem MySQL...<br/>');
        }

        if(!mysqli_select_db($db_lnk, 'mojaBaza'))
        {
            echo 'Nie udało się wybrać bazy: mojaBaza<br/>';
        }

        $query = "SELECT * FROM samochody WHERE id = $id";
        if(!$result = mysqli_query($db_lnk, $query))
        {
            mysqli_close($db_lnk);
            echo 'Nieprawidłowe zapytanie';
            exit;
        }
        else
        {
            $row = mysqli_fetch_row($result);
        }

        if(!mysqli_close($db_lnk))
        {
            echo 'Wystąpił błąd podczas zamykania połączenia z serwerem MySQL<br/>';
        }
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacje o samochodzie</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }

        h1, h2 {
            color: #555;
        }

        .info-item {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item strong {
            font-weight: bold;
            color: #777;
            display: block;
            margin-bottom: 5px;
        }

        .car-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        a:link, a:visited {
        background-color: #f44336;
        color: white;
        padding: 14px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        }

        a:hover, a:active {
        background-color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Informacje o samochodzie</h1>
        <img src="car.png" alt="Zdjęcie samochodu" class="car-image">

        <div class="info-item">
            <strong>Marka:</strong>
            <span id="marka"><?php echo $row[1];?></span>
        </div>

        <div class="info-item">
            <strong>Model:</strong>
            <span id="model"><?php echo $row[2];?></span>
        </div>

        <div class="info-item">
            <strong>Cena:</strong>
            <span id="cena"><?php echo $row[3];?></span>
        </div>

        <div class="info-item">
            <strong>Rocznik:</strong>
            <span id="rocznik"><?php echo $row[4];?></span>
        </div>

        <div class="info-item">
            <strong>Opis:</strong>
            <p id="opis"><?php echo $row[5];?></p>
        </div>
        <a href="index.php">Powrót</a>
    </div>
</body>
</html>