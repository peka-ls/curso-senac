<?php
include '../conexao.php';
//receber os dados dos names do frontend
$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$cnpj = $_REQUEST['cnpj'];
$senha = $_REQUEST['senha'];
$endereco = $_REQUEST['endereco'];
$telefone = $_REQUEST['telefone'];
$foto = $_REQUEST['foto'];
$mapa = $_REQUEST['mapa'];

//inserção em SQL - linguagem do banco
$sql = "INSERT INTO mercado(nome, email, cnpj, senha, endereco, telefone, foto, mapa) 
VALUES ('$nome','$email','$cnpj','$senha','$endereco','$telefone','$foto','$mapa')";
//executar
$resultado = mysqli_query($conexao, $sql);
//atualizar a pagina
header('Location:   ../../mercado.php');
?>