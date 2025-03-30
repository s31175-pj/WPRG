<?php
function czyPierwsza($liczba, &$iteracje) {
    if ($liczba <= 1) {
        return false;
    }
    if ($liczba <= 3) {
        return true;
    }
    if ($liczba % 2 == 0 || $liczba % 3 == 0) {
        return false;
    }
    $i = 5;
    while ($i * $i <= $liczba) {
        $iteracje++;
        if ($liczba % $i == 0 || $liczba % ($i + 2) == 0) {
            return false;
        }
        $i += 6;
    }
    return true;
}

if (isset($_POST['liczba'])) {
    $liczba = $_POST['liczba'];
    if (is_numeric($liczba) && $liczba > 0 && floor($liczba) == $liczba) {
        $iteracje = 0;
        if (czyPierwsza($liczba, $iteracje)) {
            echo "$liczba jest liczbą pierwszą.<br>";
        } else {
            echo "$liczba nie jest liczbą pierwszą.<br>";
        }
        echo "Liczba iteracji: $iteracje";
    } else {
        echo "Podaj poprawną liczbę całkowitą dodatnią.";
    }
}
?>