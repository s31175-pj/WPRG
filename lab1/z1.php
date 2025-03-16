<?php
    $owoce = array ("jabłko","banan","pomarańcza");

    for($i=(count($owoce)-1); $i>=0;$i--)
    {
        echo " ".$owoce[$i];
        if($owoce[$i][0]=="p") echo " [prawda]";
        else echo " [fałsz]";
    }
?>