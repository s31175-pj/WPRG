<?php
if (!$db_lnk = mysqli_connect("localhost", "root", ""))
{
    exit('Nie udało się połączyć z serwerem MySQL...<br/>');
}
// else
// {
//     echo 'Połączenie z bazą danych zostało nawiązane<br/>';
// }

if(!mysqli_select_db($db_lnk, 'mojaBaza'))
{
    echo 'Nie udało się wybrać bazy: mojaBaza<br/>';
}
// else
// {
//     echo 'Baza danych: mojaBaza została wybrana<br/>';
// }

$query = 'SELECT * FROM samochody ORDER BY rok ASC';
if(!$result = mysqli_query($db_lnk, $query))
{
    mysqli_close($db_lnk);
    echo 'Nieprawidłowe zapytanie';
    exit;
}

if(!mysqli_close($db_lnk))
{
    echo 'Wystąpił błąd podczas zamykania połączenia z serwerem MySQL<br/>';
}
// else
// {
//     echo 'Połączenie z serwerem MySQL zostało zamknięte...<br/>';
// }
    
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Samochodowy - Wszystkie samochody</title>
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
        <h2>Wszystkie samochody</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Cena</th>
                    <th>Szczegóły</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                while($row = mysqli_fetch_row($result))
                {
                    $i++;
                    echo "<tr>";
                    echo "<td>$row[0]</td>";
                    echo "<td>$row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<td>$row[3]</td>";
                    echo "<td>";
                    echo "<form method='post' action='carinfo.php'>";
                    echo "<input type='hidden' id='id' name='id' value='$row[0]'>";
                    echo "<input type='submit' value='Wyświetl'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>