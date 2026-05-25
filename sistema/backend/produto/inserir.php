<?php
include '../conexao.php';
//receber os dados dos names do frontend
    $id = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $preco = $_REQUEST['preco'];
    $disponibilidade = $_REQUEST['disponibilidade'];
    $imagem = $_REQUEST['imagem'];
    $mercado = $_REQUEST['mercado'];

//inserção em SQL - linguagem do banco
$sql = "INSERT INTO produto(nome, preco, disponibilidade, imagem, mercado_id) VALUES ('$nome','$preco','$disponibilidade','$imagem', '$mercado')";
//executar
$resultado = mysqli_query($conexao, $sql);
//atualizar a pagina
header('Location:   ../../produto.php');
?>