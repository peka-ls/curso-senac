<?php
include '../conexao.php';
include '../upload.php';

$nome = mysqli_real_escape_string($conexao, $_POST['nome'] ?? '');
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao'] ?? '');
$foto = mysqli_real_escape_string($conexao, salvarUpload('foto', 'receitas'));

$sql = "INSERT INTO receita(nome, foto, descricao) VALUES ('$nome', '$foto', '$descricao')";
mysqli_query($conexao, $sql);

header('location:../../receita.php');
?>
