<?php
function isPrime($num) {
    if ($num <= 1) {
        return false;
    }
    
    // Check divisibility from 2 to sqrt($num)
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false; // If divisible, not a prime
        }
    }
    return true; // If not divisible by any number, it's prime
}

foreach (range(0,200) as $value)
{
    if(isPrime($value)) echo " $value";
}
?>