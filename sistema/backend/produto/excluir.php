<?php 
    include '../conexao.php';

    $id = $_REQUEST['id'];

    mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id='$id'");
    $sql = "DELETE FROM produto WHERE id='$id' ";
    $resultado = mysqli_query($conexao, $sql);

    header('location:../../produto.php');
?>
