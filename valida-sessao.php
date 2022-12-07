<?php

session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Você deve logar primeiro!');</script>";
    echo "<script>window.location='login.html';</script>";
    exit();
} else {
    $id = $_SESSION['id'];
}

?>