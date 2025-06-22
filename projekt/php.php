<?php

    function redirect($url_docelowy)
    {
        echo '<form id="przekierowanie" method="post" action="' . htmlspecialchars($url_docelowy) . '">';
            echo '<input type="hidden" name="reason" value="session_active">';
        echo '</form>';
        echo '<script>document.getElementById("przekierowanie").submit();</script>';
        exit();
    }

    function connect_db($query, $type, ...$args)
    {

        $conn = new mysqli("localhost", "root", "", "shroomforum");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param($type, ...$args);

        return $stmt;
    }
?>