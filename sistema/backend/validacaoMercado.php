<?php
session_start();

if (!isset($_SESSION['mercado_id'])) {
    session_destroy();
    header('location:loginMercado.php');
    exit;
}
?>
