<?php
include 'backend/conexao.php';

$id = mysqli_real_escape_string($conexao, $_GET['id'] ?? 0);

$dadosMercado = mysqli_query($conexao, "SELECT * FROM mercado WHERE id = '$id'");
$mercado = mysqli_fetch_assoc($dadosMercado);

if (!$mercado) {
    echo "Mercado nao encontrado";
    exit;
}

@mysqli_query($conexao, "UPDATE mercado SET visualizacoes = visualizacoes + 1 WHERE id='$id'");

$produtos = mysqli_query($conexao, "SELECT * FROM produto WHERE mercado_id = '$id' ORDER BY nome");
$fotoMercado = !empty($mercado['foto']) ? $mercado['foto'] : 'assets/imagens/mercadinho2.png';
$telefoneWhatsapp = preg_replace('/\D/', '', $mercado['telefone']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecolote - <?= $mercado['nome']; ?></title>
    <link rel="stylesheet" href="paginaInicial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg corbarra">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">Ecolote</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Mercados</a></li>
                    <li class="nav-item"><a class="nav-link" href="loginMercado.php">Login do mercado</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="market-hero" style="background-image: linear-gradient(90deg, rgba(51,6,114,.86), rgba(51,6,114,.42)), url('<?= $fotoMercado; ?>');">
        <div class="container">
            <h1><?= $mercado['nome']; ?></h1>
            <p><?= $mercado['endereco']; ?></p>
        </div>
    </header>

    <section class="container market-info">
        <div class="info-grid">
            <div><strong>Email</strong><span><?= $mercado['email']; ?></span></div>
            <div><strong>Telefone</strong><span><?= $mercado['telefone']; ?></span></div>
            <div><strong>Endereco</strong><span><?= $mercado['endereco']; ?></span></div>
            <div><strong>Visualizacoes</strong><span><?= $mercado['visualizacoes'] ?? 0; ?></span></div>
        </div>
        <?php if (!empty($mercado['mapa'])) { ?>
            <div class="map-box mt-4">
                <?= $mercado['mapa']; ?>
            </div>
        <?php } ?>
    </section>

    <main class="container py-5">
        <div class="section-title">
            <h2>Produtos disponiveis</h2>
            <p>Fale com o mercado pelo WhatsApp para confirmar a disponibilidade.</p>
        </div>
        <div class="row g-4">
            <?php while ($produto = mysqli_fetch_assoc($produtos)) {
                $imagemProduto = !empty($produto['imagem']) ? $produto['imagem'] : 'assets/imagens/gugao.png';
                $mensagem = rawurlencode("Ola, gostaria de saber se o produto " . $produto['nome'] . " esta disponivel.");
                $receitas = mysqli_query($conexao, "SELECT receita.* FROM receita INNER JOIN produto_receita ON receita.id = produto_receita.receita_id WHERE produto_receita.produto_id = '{$produto['id']}' ORDER BY receita.nome");
            ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="modern-card product-card h-100">
                        <img src="<?= $imagemProduto; ?>" class="card-img-top" alt="<?= $produto['nome']; ?>">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <h3><?= $produto['nome']; ?></h3>
                                <strong class="price-tag"><?= $produto['preco']; ?></strong>
                            </div>
                            <p><?= $produto['disponibilidade']; ?></p>
                            <a class="btn btn-success w-100 mb-3" target="_blank" href="https://wa.me/55<?= $telefoneWhatsapp; ?>?text=<?= $mensagem; ?>">Perguntar no WhatsApp</a>
                            <div class="recipe-list">
                                <strong>Receitas com este produto</strong>
                                <?php if (mysqli_num_rows($receitas) > 0) { ?>
                                    <ul>
                                        <?php while ($receita = mysqli_fetch_assoc($receitas)) { ?>
                                            <li>
                                                <?php if (!empty($receita['foto'])) { ?>
                                                    <img src="<?= $receita['foto']; ?>" alt="<?= $receita['nome']; ?>">
                                                <?php } ?>
                                                <span><?= $receita['nome']; ?></span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <p class="mb-0">Nenhuma receita vinculada.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php } ?>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <span><?= $mercado['nome']; ?> no Ecolote.</span>
            <span>Consulte o mercado antes de finalizar sua compra.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>
