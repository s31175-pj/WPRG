<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

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

    $file = fopen("z1.csv", "a");
    
    $line = array($people_amount, $name, $surname, $address, $credit_card, $email, $date, $time, $baby_bed, $options);
    
    fputcsv($file, $line, ";");

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

    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                setcookie($key, serialize($value), time() + (86400 * 30), "/");
            } else {
                setcookie($key, $value, time() + (86400 * 30), "/");
            }
        }
    }

   

?>
Formularz został zapisany, aby wyświetlić zapisane wyniki, wciśnij przycisk:
</br>
<button onclick="document.location='z1.2.php'">Wyświetl</button>


</body>
</html>
