<?php
$myfile = fopen("z2.txt", "a") or die("Unable to open file!");
if (isset($_POST["pole1"], $_POST["pole2"], $_POST["pole3"])) {
    
    $pole1 = $_POST["pole1"];
    $pole2 = $_POST["pole2"];
    $pole3 = $_POST["pole3"];
    $txt = $pole1 . "\n" . $pole2 . "\n" . $pole3;
    fwrite($myfile, "\n" . $txt);
    fclose($myfile);
}


?>