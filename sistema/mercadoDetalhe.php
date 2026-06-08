<?php
include 'backend/conexao.php';
//pega o id do mercado que foi transportado pela URL
$id = $_GET['id'] ?? 0;

$dadosMercado = mysqli_query($conexao, "SELECT * FROM mercado WHERE id = '$id'");
$mercado = mysqli_fetch_assoc($dadosMercado);

//se mercado não existir
if (!$mercado) {
    echo "mercado não encontrado";
    exit;
}

//busca produtos somente desse mercado
$produtos = mysqli_query($conexao, "SELECT * FROM produto WHERE mercado_id = '$id' ORDER BY nome");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecolote</title>
    <link rel="stylesheet" href="paginaInicial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg corbarra">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> <i class="fa-solid fa-alarm-clock" style="color: rgb(255, 255, 255);"></i> Ecolote </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Mercados</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Produtos</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Receitas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2 class="text-center"> <?= $mercado['nome']; ?> </b> </h2>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1830 85.285">
        <g transform="translate(0 -2185)">
            <path d="M4661.665,1785.181c-259.119,3.056-375.993,61.328-576.223,58.3-214.726-3.241-313.76-58.487-572.881-55.435-143.507,1.692-260.3,20.072-313.545,34.408v47.86h1830v-39.258C4967.885,1808.12,4859.114,1782.856,4661.665,1785.181Z" transform="translate(-3199.016 399.968)" fill="#330672"></path>
        </g>
    </svg>
    <section style="background-color: #330672; margin-top: -5px; height: 150px; border-bottom: 5px solid oklch(85.2% 0.199 91.936);">
        <p class="text-center text-white" style="font-size: 20px; padding: 15px;">
            <?= $mercado['endereco'] ?> <br> <?= $mercado['telefone']; ?> <br> <?= $mercado['mapa'] ?>
        </p>
    </section>

    <div class="container">
        <div class="row">
            <?php
            while ($coluna = mysqli_fetch_assoc($produtos)) {
            ?>
                <div class="col-12 col-md-6 col-lg-3 mt-4 d-flex justify-content-center">
                    <div class="card" style="width: 16rem;">
                        <img src="<?= $coluna['imagem']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"> <?= $coluna['nome']; ?> </h5>
                            <p class="card-text"> <?= $coluna['preco']; ?> </p>
                            <a href="#" class="btn btn-primary">acessar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>