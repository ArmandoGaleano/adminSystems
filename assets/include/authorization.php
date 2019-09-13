<?php
    session_start();
    if(!isset($_SESSION['adminUser'])){
        header('Location: index.php');
    }
?>