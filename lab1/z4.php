<?php

$tekst = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

$tablica = explode(" ", $tekst);

$znaki_interpunkcyjne = ['.', ',', "'"];

for ($i = 0; $i < count($tablica); $i++) {
    for ($j = 0; $j < strlen($tablica[$i]); $j++) {
        if (in_array($tablica[$i][$j], $znaki_interpunkcyjne)) {
            $tablica[$i] = str_replace($tablica[$i][$j], '', $tablica[$i]);
        }
    }
}

$tablica = array_filter($tablica);
$tablica = array_values($tablica);

$tablica_asocjacyjna = [];
for ($i = 0; $i < count($tablica) - 1; $i += 2) {
    if (isset($tablica[$i + 1])) { // warunek sprawdzający, czy istnieje następny element
        $tablica_asocjacyjna[$tablica[$i]] = $tablica[$i + 1];
    } else {
         $tablica_asocjacyjna[$tablica[$i]] = '';
    }

}

foreach ($tablica_asocjacyjna as $klucz => $wartosc) {
    echo $klucz . " => " . $wartosc . "\n";
}

?>