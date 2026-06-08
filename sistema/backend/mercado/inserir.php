<?php
include '../conexao.php';
include '../upload.php';
//receber os dados dos names do frontend
$nome = mysqli_real_escape_string($conexao, $_REQUEST['nome']);
$email = mysqli_real_escape_string($conexao, $_REQUEST['email']);
$cnpj = mysqli_real_escape_string($conexao, $_REQUEST['cnpj']);
$senha = mysqli_real_escape_string($conexao, $_REQUEST['senha']);
$endereco = mysqli_real_escape_string($conexao, $_REQUEST['endereco']);
$telefone = mysqli_real_escape_string($conexao, $_REQUEST['telefone']);
$foto = mysqli_real_escape_string($conexao, salvarUpload('foto', 'mercados'));
$mapa = mysqli_real_escape_string($conexao, $_REQUEST['mapa']);

//inserção em SQL - linguagem do banco
$sql = "INSERT INTO mercado(nome, email, cnpj, senha, endereco, telefone, foto, mapa) 
VALUES ('$nome','$email','$cnpj','$senha','$endereco','$telefone','$foto','$mapa')";
//executar
$resultado = mysqli_query($conexao, $sql);
//atualizar a pagina
header('Location:   ../../mercado.php');
?>
