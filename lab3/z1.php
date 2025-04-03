<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

Wynik: 
<?php
    include "./z1func.php";

    if (isset($_POST["operacja"])) {
        $liczba1 = $_POST["liczba1"];
        $liczba2 = $_POST["liczba2"];
        $operacja = $_POST["operacja"];

        switch ($operacja) {
            case "dodawanie":
                add($liczba1, $liczba2);
                break;
            case "odejmowanie":
                sub($liczba1, $liczba2);
                break;
            case "mnozenie":
                mul($liczba1, $liczba2);
                break;
            case "dzielenie":
                div($liczba1, $liczba2);
                break;
            default:
                echo "Nieznana operacja.";
        }
    } else {
        echo "Brak danych do obliczeń.";
    }
?>


</body>
</html>