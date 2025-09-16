<?php
    session_start();
    session_unset(); // Briše sve sesijske promenljive
    session_destroy();
    
    header("Location: index.php");
    exit;
?>
