<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do mercado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/cssParticles.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="corpoLogin">
    <div class="row justify-content-center align-items-center vh-100 painel">
        <div class="col-10 col-sm-9 col-md-6 col-lg-4 card shadow p-3 telaLogin">
            <div class="text-center">
                <i class="fa-solid fa-shop fa-2x" style="color: rgb(116, 192, 252); font-size: 70px;"></i>
                <h3 class="m-4"> Login do Mercado</h3>
            </div>
            <?php if (!empty($_GET['erro'])) { ?>
                <div class="alert alert-danger">Email ou senha inválidos.</div>
            <?php } ?>
            <form action="./backend/mercado/logar.php" method="post">
                <div class="mb-3">
                    <label class="form-label"> Email </label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Senha </label>
                    <input type="password" name="senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary"> Entrar </button>
                <a href="index.php" class="btn btn-secondary"> Voltar </a>
            </form>
        </div>
    </div>
    <div id="particles-js"></div>
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="assets/particles.js"></script>
</body>
</html>
