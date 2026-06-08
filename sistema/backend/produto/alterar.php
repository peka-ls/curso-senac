<?php
    include '../conexao.php';
    include '../upload.php';

    $id = mysqli_real_escape_string($conexao, $_REQUEST['id']);
    $nome = mysqli_real_escape_string($conexao, $_REQUEST['nome']);
    $preco = mysqli_real_escape_string($conexao, $_REQUEST['preco']);
    $disponibilidade = mysqli_real_escape_string($conexao, $_REQUEST['disponibilidade']);
    $imagemAtual = $_REQUEST['imagem_atual'] ?? '';
    $imagem = mysqli_real_escape_string($conexao, salvarUpload('imagem', 'produtos', $imagemAtual));
    $mercado = mysqli_real_escape_string($conexao, $_REQUEST['mercado']);
    $origem = $_POST['origem'] ?? '';

    $sql = "UPDATE produto SET nome='$nome', preco='$preco', disponibilidade='$disponibilidade', imagem='$imagem', mercado_id='$mercado' WHERE id='$id' ";

    mysqli_query($conexao, $sql);
    mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id='$id'");

    if (!empty($_POST['receitas'])) {
        foreach ($_POST['receitas'] as $receitaId) {
            $receitaId = mysqli_real_escape_string($conexao, $receitaId);
            mysqli_query($conexao, "INSERT INTO produto_receita(produto_id, receita_id) VALUES ('$id', '$receitaId')");
        }
    }

    header('location:../../' . ($origem === 'mercado' ? 'mercadoPainel.php' : 'produto.php'));
?>

