<?php
include '../conexao.php';
include '../upload.php';
//receber os dados dos names do frontend
    $nome = mysqli_real_escape_string($conexao, $_REQUEST['nome']);
    $preco = mysqli_real_escape_string($conexao, $_REQUEST['preco']);
    $disponibilidade = mysqli_real_escape_string($conexao, $_REQUEST['disponibilidade']);
    $imagem = mysqli_real_escape_string($conexao, salvarUpload('imagem', 'produtos'));
    $mercado = mysqli_real_escape_string($conexao, $_REQUEST['mercado']);
    $origem = $_POST['origem'] ?? '';

//inserção em SQL - linguagem do banco
$sql = "INSERT INTO produto(nome, preco, disponibilidade, imagem, mercado_id) VALUES ('$nome','$preco','$disponibilidade','$imagem', '$mercado')";
//executar
$resultado = mysqli_query($conexao, $sql);
$produtoId = mysqli_insert_id($conexao);

if (!empty($_POST['receitas'])) {
    foreach ($_POST['receitas'] as $receitaId) {
        $receitaId = mysqli_real_escape_string($conexao, $receitaId);
        mysqli_query($conexao, "INSERT INTO produto_receita(produto_id, receita_id) VALUES ('$produtoId', '$receitaId')");
    }
}
//atualizar a pagina
header('Location: ../../' . ($origem === 'mercado' ? 'mercadoPainel.php' : 'produto.php'));
?>
