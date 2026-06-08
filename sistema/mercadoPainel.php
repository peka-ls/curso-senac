<?php
  include './backend/conexao.php';
  include './backend/validacaoMercado.php';

  $mercadoId = $_SESSION['mercado_id'];
  $destino = "./backend/produto/inserir.php";

  if(!empty($_GET['id'])){
    $id = mysqli_real_escape_string($conexao, $_GET['id']);
    $dados = mysqli_query($conexao, "SELECT * FROM produto WHERE id='$id' AND mercado_id='$mercadoId'");
    $produtos = mysqli_fetch_assoc($dados);
    $destino = "./backend/produto/alterar.php";

    if (!$produtos) {
      header('location:mercadoPainel.php');
      exit;
    }

    $receitasProduto = [];
    $dadosReceitasProduto = mysqli_query($conexao, "SELECT receita_id FROM produto_receita WHERE produto_id='$id'");
    while ($receitaProduto = mysqli_fetch_assoc($dadosReceitasProduto)) {
      $receitasProduto[] = $receitaProduto['receita_id'];
    }
  }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel do Mercado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
  </head>
  <body>
   <nav class="navbar navbar-expand-lg corbarra">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-shop" style="color: white;"></i> Painel do Mercado</a>
      <div class="ms-auto">
        <span class="text-white me-3"><?php echo $_SESSION['mercado_nome']; ?></span>
        <a href="backend/sair.php" class="btn btn-light btn-sm">Sair</a>
      </div>
    </div>
  </nav>
    
   <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
              <form action="<?=$destino?>" method="post" enctype="multipart/form-data" class="p-3">
                <h3><i class="fa-solid fa-basket-shopping"></i> Produto do mercado</h3>
                <input value="<?php echo isset($produtos) ? $produtos['id'] : "" ?>" type="hidden" name="id">
                <input value="<?=$mercadoId?>" type="hidden" name="mercado">
                <input value="mercado" type="hidden" name="origem">
                <div class="mb-3">
                    <label class="form-label"> Nome do produto </label>
                    <input value="<?php echo isset($produtos) ? $produtos['nome'] : "" ?>" type="text" name="nome" class="form-control" required>
                </div>
                 <div class="mb-3">
                    <label class="form-label"> Preço </label>
                    <input value="<?php echo isset($produtos) ? $produtos['preco'] : "" ?>" type="text" name="preco" class="form-control mascara-preco" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Disponibilidade </label>
                    <input value="<?php echo isset($produtos) ? $produtos['disponibilidade'] : "" ?>" type="text" name="disponibilidade" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Imagem </label>
                    <input value="<?php echo isset($produtos) ? $produtos['imagem'] : "" ?>" type="hidden" name="imagem_atual">
                    <input type="file" name="imagem" class="form-control" accept="image/*">
                    <?php if (!empty($produtos['imagem'])) { ?>
                      <img src="<?= $produtos['imagem'] ?>" class="preview-upload mt-2" alt="Imagem do produto">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Receitas vinculadas </label>
                    <select name="receitas[]" class="form-select" multiple size="5">
                      <?php 
                        $buscaReceitas = mysqli_query($conexao, "SELECT * FROM receita ORDER BY nome");
                        while($receita = $buscaReceitas->fetch_assoc()) {
                          $selecionada = (isset($receitasProduto) && in_array($receita['id'], $receitasProduto)) ? 'selected' : '';
                      ?>
                      <option value="<?=$receita['id']?>" <?=$selecionada?>><?= $receita['nome'] ?></option> 
                      <?php  }?>
                     </select> 
                </div>
                <button type="submit" class="btn btn-primary"> Salvar </button>
                <button type="reset" class="btn btn-secondary"> Limpar </button>
            </form>
            </div>
            <div class="col-md-7"> 
              <br>
              <h3><i class="fa-solid fa-address-book"></i> Meus produtos</h3>
              <table class="table" id="tabela">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Preço</th>
                  <th>Disponibilidade</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $dados = mysqli_query($conexao, "SELECT * FROM produto WHERE mercado_id='$mercadoId' ORDER BY nome");
                  while($coluna = mysqli_fetch_assoc($dados)){
                ?>
                <tr>
                  <th><?php echo $coluna['id'] ?></th>
                  <td><?php echo $coluna['nome'] ?></td>
                  <td><?php echo $coluna['preco'] ?></td>
                  <td><?php echo $coluna['disponibilidade'] ?></td>
                  <td>
                    <a href="./mercadoPainel.php?id=<?=$coluna['id']?>"><i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i></a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div>
        </div>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="assets/script.js"></script>
  </body>
</html>
