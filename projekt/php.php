<?php
    function redirect($url_docelowy)
    {
        echo '<form id="przekierowanie" method="post" action="' . htmlspecialchars($url_docelowy) . '">';
            echo '<input type="hidden" name="reason" value="session_active">';
        echo '</form>';
        echo '<script>document.getElementById("przekierowanie").submit();</script>';
        exit();
    }

    function connect_db($db, $db_user, $db_pass, $db_name, $db_query)
    {
        if (!$db_lnk = mysqli_connect($db, $db_user, $db_pass))
        {
            exit('Nie udało się połączyć z serwerem MySQL...<br/>');
        }

        if(!mysqli_select_db($db_lnk, $db_name))
        {
            echo 'Nie udało się wybrać bazy: shroomforum<br/>';
            exit;
        }

        if(!$result = mysqli_query($db_lnk, $db_query))
        {
            mysqli_close($db_lnk);
            echo 'Nieprawidłowe zapytanie';
            exit;
        }
        return $result;
    }
?>