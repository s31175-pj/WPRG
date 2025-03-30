<?php
    $liczba_osob = $_POST['liczba_osob'];

    echo "<h2>Podsumowanie rezerwacji:</h2>";

    for ($i = 1; $i <= $liczba_osob; $i++) {
        $imie_osoba = $_POST["imie_osoba_$i"];
        $nazwisko_osoba = $_POST["nazwisko_osoba_$i"];
        $email_osoba = $_POST["email_osoba_$i"];

        echo "<h3>Osoba $i:</h3>";
        echo "Imię: $imie_osoba<br>";
        echo "Nazwisko: $nazwisko_osoba<br>";
        echo "E-mail: $email_osoba<br><br>";
    }
?>