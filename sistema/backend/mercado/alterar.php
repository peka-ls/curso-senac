<?php
    include '../conexao.php';

    $id = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $email = $_REQUEST['email'];
    $cnpj = $_REQUEST['cnpj'];
    $senha = $_REQUEST['senha'];
    $endereco = $_REQUEST['endereco'];
    $telefone = $_REQUEST['telefone'];
    $foto = $_REQUEST['foto'];
    $mapa = $_REQUEST['mapa'];

    $sql = "UPDATE mercado SET nome='$nome', email='$email', cnpj='$cnpj', senha='$senha', endereco ='$endereco', telefone='$telefone', foto = '$foto', mapa = '$mapa' WHERE id='$id' ";

    mysqli_query($conexao, $sql);

    header('location:../../mercado.php');
?>

