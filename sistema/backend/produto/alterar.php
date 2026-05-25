<?php
    include '../conexao.php';

    $id = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $preco = $_REQUEST['preco'];
    $disponibilidade = $_REQUEST['disponibilidade'];
    $imagem = $_REQUEST['imagem'];

    $sql = "UPDATE produto SET nome='$nome', preco='$preco', disponibilidade='$disponibilidade', imagem='$imagem' WHERE id='$id' ";

    mysqli_query($conexao, $sql);

    header('location:../../produto.php');
?>

