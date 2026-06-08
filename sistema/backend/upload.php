<?php
function salvarUpload($campo, $pasta, $valorAtual = '')
{
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        return $valorAtual;
    }

    $permitidos = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $nomeOriginal = $_FILES[$campo]['name'];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    if (!in_array($extensao, $permitidos)) {
        return $valorAtual;
    }

    $diretorio = __DIR__ . "/../assets/uploads/$pasta/";

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $nomeArquivo = uniqid($pasta . '_', true) . '.' . $extensao;
    $destino = $diretorio . $nomeArquivo;

    if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino)) {
        return "assets/uploads/$pasta/$nomeArquivo";
    }

    return $valorAtual;
}
?>
