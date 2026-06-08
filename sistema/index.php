<?php
include 'backend/conexao.php';

$mercados = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY nome");
$totalMercados = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM mercado"))['total'] ?? 0;
$totalProdutos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM produto"))['total'] ?? 0;
$visualizacoes = 0;

@mysqli_query($conexao, "INSERT INTO site_stats(pagina, visualizacoes) VALUES ('index', 1) ON DUPLICATE KEY UPDATE visualizacoes = visualizacoes + 1");
$dadosViews = @mysqli_query($conexao, "SELECT visualizacoes FROM site_stats WHERE pagina='index'");

if ($dadosViews) {
  $visualizacoes = mysqli_fetch_assoc($dadosViews)['visualizacoes'] ?? 0;
}
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
      <a class="navbar-brand fw-bold" href="index.php">Ecolote</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#mercados">Mercados</a></li>
          <li class="nav-item"><a class="nav-link" href="loginMercado.php">Login do mercado</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Administrativo</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExample" class="carousel slide hero-carousel" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/imagens/imagem1.png" class="d-block w-100" alt="Produtos economicos">
      </div>
      <div class="carousel-item">
        <img src="assets/imagens/imagem2.png" class="d-block w-100" alt="Mercados parceiros">
      </div>
      <div class="carousel-item">
        <img src="assets/imagens/imagem3.png" class="d-block w-100" alt="Compras conscientes">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Proximo</span>
    </button>
  </div>

  <section class="intro-ecolote">
    <div class="container">
      <h1>Bem-vindo ao <span>Ecolote</span></h1>
      <p>Encontre mercados com produtos acessiveis, economize nas compras e ajude a reduzir o desperdicio.</p>
      <div class="social-proof">
        <div><strong><?= $totalMercados ?></strong><small>mercados cadastrados</small></div>
        <div><strong><?= $totalProdutos ?></strong><small>produtos anunciados</small></div>
        <div><strong><?= $visualizacoes ?></strong><small>visualizacoes na pagina</small></div>
      </div>
    </div>
  </section>

  <main class="container py-5" id="mercados">
    <div class="section-title">
      <h2>Mercados parceiros</h2>
      <p>Escolha um mercado para ver produtos, contato e receitas relacionadas.</p>
    </div>
    <div class="row g-4">
      <?php while ($mercado = mysqli_fetch_assoc($mercados)) { 
        $fotoMercado = !empty($mercado['foto']) ? $mercado['foto'] : 'assets/imagens/mercadinho2.png';
      ?>
        <div class="col-12 col-md-6 col-lg-3">
          <article class="modern-card market-card h-100">
            <img src="<?= $fotoMercado; ?>" class="card-img-top" alt="<?= $mercado['nome']; ?>">
            <div class="card-body">
              <h3><?= $mercado['nome']; ?></h3>
              <p><?= $mercado['endereco']; ?></p>
              <span><?= $mercado['telefone']; ?></span>
              <a href="mercadoDetalhe.php?id=<?= $mercado['id'] ?>" class="btn btn-primary w-100 mt-3">Ver mercado</a>
            </div>
          </article>
        </div>
      <?php } ?>
    </div>
  </main>

  <footer class="site-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
      <span>Ecolote - economia e consumo consciente.</span>
      <span>Mercados podem acessar pelo login exclusivo.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>
