<?php
    include 'config.php';
    unset($_SESSION['user']);
    header('location: login.php');
?>