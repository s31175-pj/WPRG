<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

Wynik: 
<?php
    if (isset($_POST["operacja"])) {
        $liczba1 = $_POST["liczba1"];
        $liczba2 = $_POST["liczba2"];
        $operacja = $_POST["operacja"];

        switch ($operacja) {
            case "dodawanie":
                $wynik = $liczba1 + $liczba2;
                break;
            case "odejmowanie":
                $wynik = $liczba1 - $liczba2;
                break;
            case "mnozenie":
                $wynik = $liczba1 * $liczba2;
                break;
            case "dzielenie":
                if ($liczba2 != 0) {
                    $wynik = $liczba1 / $liczba2;
                } else {
                    $wynik = "Nie można dzielić przez zero.";
                }
                break;
            default:
                $wynik = "Nieznana operacja.";
        }
        echo "Wynik: " . $wynik;
    } else {
        echo "Brak danych do obliczeń.";
    }
?>


</body>
</html>