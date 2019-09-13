<?php
    session_start();
    if(isset($_SESSION['adminUser'])){
        unset($_SESSION['adminUser']);
        header("location: index.php");
    }else{
    header("location: index.php");
    }
?>
