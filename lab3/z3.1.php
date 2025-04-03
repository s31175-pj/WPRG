<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wyświetl Rezerwacje</title>
</head>
<body>
    <h1>Lista Rezerwacji</h1>

    <?php
    $file = fopen("z3.csv", "r");

    if ($file) {
        echo "<table border='1'>";
        $header = fgetcsv($file, 0, ";"); // Odczytaj nagłówek
        if ($header) {
            echo "<tr>";
            foreach ($header as $col) {
                echo "<th>" . htmlspecialchars($col) . "</th>";
            }
            echo "</tr>";
        }

        while (($row = fgetcsv($file, 0, ";")) !== false) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        fclose($file);
    } else {
        echo "<p>Nie można otworzyć pliku z rezerwacjami.</p>";
    }
    ?>
    <br>
    <button onclick="document.location='index.html'">Powrót do Formularza</button>
</body>
</html>