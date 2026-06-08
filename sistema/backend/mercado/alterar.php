<?php
    include '../conexao.php';
    include '../upload.php';

    $id = mysqli_real_escape_string($conexao, $_REQUEST['id']);
    $nome = mysqli_real_escape_string($conexao, $_REQUEST['nome']);
    $email = mysqli_real_escape_string($conexao, $_REQUEST['email']);
    $cnpj = mysqli_real_escape_string($conexao, $_REQUEST['cnpj']);
    $senha = mysqli_real_escape_string($conexao, $_REQUEST['senha']);
    $endereco = mysqli_real_escape_string($conexao, $_REQUEST['endereco']);
    $telefone = mysqli_real_escape_string($conexao, $_REQUEST['telefone']);
    $fotoAtual = $_REQUEST['foto_atual'] ?? '';
    $foto = mysqli_real_escape_string($conexao, salvarUpload('foto', 'mercados', $fotoAtual));
    $mapa = mysqli_real_escape_string($conexao, $_REQUEST['mapa']);

    $sql = "UPDATE mercado SET nome='$nome', email='$email', cnpj='$cnpj', senha='$senha', endereco ='$endereco', telefone='$telefone', foto = '$foto', mapa = '$mapa' WHERE id='$id' ";

    mysqli_query($conexao, $sql);

    header('location:../../mercado.php');
?>

