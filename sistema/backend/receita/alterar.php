<?php
include '../conexao.php';
include '../upload.php';

$id = mysqli_real_escape_string($conexao, $_POST['id'] ?? '');
$nome = mysqli_real_escape_string($conexao, $_POST['nome'] ?? '');
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao'] ?? '');
$fotoAtual = $_POST['foto_atual'] ?? '';
$foto = mysqli_real_escape_string($conexao, salvarUpload('foto', 'receitas', $fotoAtual));

$sql = "UPDATE receita SET nome='$nome', foto='$foto', descricao='$descricao' WHERE id='$id'";
mysqli_query($conexao, $sql);

header('location:../../receita.php');
?>
