<?php
function add($num1, $num2)
{
    $out = $num1 + $num2;
    echo $out;
}

function sub($num1, $num2)
{
    $out = $num1 - $num2;
    echo $out;
}

function mul($num1, $num2)
{
    $out = $num1 * $num2;
    echo $out;
}

function div($num1, $num2)
{   
    if ($num2 == 0)
    {
        echo "Nie można dzielić przez 0";
        return;
    }
    $out = $num1 / $num2;
    echo $out;
}
?>