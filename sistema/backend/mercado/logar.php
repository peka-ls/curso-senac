<?php
include '../conexao.php';

$email = mysqli_real_escape_string($conexao, $_POST['email'] ?? '');
$senha = mysqli_real_escape_string($conexao, $_POST['senha'] ?? '');

$sql = "SELECT * FROM mercado WHERE email = '$email' AND senha = '$senha'";
$resultado = mysqli_query($conexao, $sql);
$mercado = mysqli_fetch_assoc($resultado);

if ($mercado) {
    session_start();

    $_SESSION['mercado_id'] = $mercado['id'];
    $_SESSION['mercado_nome'] = $mercado['nome'];
    $_SESSION['mercado_email'] = $mercado['email'];

    header('location:../../mercadoPainel.php');
    exit;
}

header('location:../../loginMercado.php?erro=1');
?>
