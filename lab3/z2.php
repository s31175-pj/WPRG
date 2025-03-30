<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

Formularz dla pozostałych osób:
<?php
    if (isset($_POST['liczba_osob'])) {
        $liczba_osob = $_POST['liczba_osob'];

        echo "<h2>Dane osobowe gości:</h2>";
        echo "<form method='post' action='z2.1.php'>"; // Przesyłamy dane do podsumowania

        for ($i = 1; $i <= $liczba_osob; $i++) {
            echo "<h3>Osoba $i:</h3>";
            echo "<label for='imie_osoba_$i'>Imię:</label><br>";
            echo "<input type='text' name='imie_osoba_$i' required><br><br>";

            echo "<label for='nazwisko_osoba_$i'>Nazwisko:</label><br>";
            echo "<input type='text' name='nazwisko_osoba_$i' required><br><br>";

            echo "<label for='email_osoba_$i'>E-mail:</label><br>";
            echo "<input type='email' name='email_osoba_$i' required><br><br>";
        }

        // Przekazujemy liczbę osób do podsumowania
        echo "<input type='hidden' name='liczba_osob' value='$liczba_osob'>"; 
        echo "<input type='submit' value='Wyświetl podsumowanie'>";
        echo "</form>";

    } else {
        // Wyświetl główny formularz rezerwacji
        echo "<h2>Formularz rezerwacji hotelu</h2>";
        echo "<form method='post' action='rezerwacja.php'>";
        echo "Liczba osób: <select name='liczba_osob'>";
        echo "<option value='1'>1</option>";
        echo "<option value='2'>2</option>";
        echo "<option value='3'>3</option>";
        echo "<option value='4'>4</option>";
        echo "</select><br><br>";
        echo "<input type='submit' value='Dalej'>";
        echo "</form>";
    }
?>
</br></br></br>
Podsumowanie: 
<?php

    $people_amount = $_POST["liczba_osob"];
    $name = $_POST["imie"];
    $surname = $_POST["nazwisko"];
    $address = $_POST["adres"];
    $credit_card = $_POST["karta_kredytowa"];
    $last4 = substr($credit_card, -4);
    $email = $_POST["email"];
    $date = $_POST["data_pobytu"];
    if (isset($_POST["godzina_przyjazdu"])) 
    {
        $time = $_POST["godzina_przyjazdu"];
    }
    
    if (isset($_POST["lozko_dziecko"])) 
    {
        $baby_bed = $_POST["lozko_dziecko"];
    }

    if (isset($_POST["udogodnienia"])) 
    {
        $options = $_POST["udogodnienia"];
    }

    echo "Liczba osób: ".$people_amount."<br>";
    echo "Imię osoby rezerwującej: ".$name." ".$surname."<br>";
    echo "Adres: ".$address."<br>";
    echo "Karta kredytowa: **** **** **** ".$last4."<br>";
    echo "Adres e-mail: ".$email."<br>";
    echo "Data pobytu: ".$date."<br>";
    if (isset($time)) 
    {
        echo "Godzina przyjazdu: ".$time."<br>";
    }
    
    if (isset($baby_bed)) 
    {
        echo "Łóżko dla dziecka: Tak<br>";
    } else {
        echo "Łóżko dla dziecka: Nie<br>";
    }

    if (isset($options)) 
    {
        echo "Wybrane opcje: <br>";
        foreach ($options as $option)
        {
            echo "$option <br>";
        }
    }

?>


</body>
</html>