<?php
include '../conexao.php';

$id = mysqli_real_escape_string($conexao, $_REQUEST['id']);

mysqli_query($conexao, "DELETE FROM produto_receita WHERE receita_id='$id'");
mysqli_query($conexao, "DELETE FROM receita WHERE id='$id'");

header('location:../../receita.php');
?>
