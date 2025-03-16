<?php
function fib($num)
{
    if($num<2)
    {
        return $num;
    }

    if($num>=2)
    {
        return fib($num-1)+fib($num-2);
    }


}


$tab = array();
foreach(range(0,5) as $value)
{
    $tab[]=fib($value);
    if($value%2==0) echo "\n $value. ".$tab[$value];
}
?>
