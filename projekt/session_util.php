<?php
    session_start();

    $conn = new mysqli("localhost", "root", "", "shroomforum");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['logout']) || !$_SESSION['login_true'])
    {
        $_SESSION['login_true']=false;
        session_destroy();
    }

    if(session_status()==2)
    {
        $login = $_SESSION["login"];
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $login, $login);
        
        $stmt->execute();
        $user = $stmt->get_result()->fetch_row();
    }
?>