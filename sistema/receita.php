<?php
  include './backend/conexao.php';
  include './backend/validacao.php';

  $destino = "./backend/receita/inserir.php";

  if(!empty($_GET['id'])){
    $id = mysqli_real_escape_string($conexao, $_GET['id']);
    $dados = mysqli_query($conexao, "SELECT * FROM receita WHERE id='$id'");
    $receitas = mysqli_fetch_assoc($dados);
    $destino = "./backend/receita/alterar.php";
  }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ecolote </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
  </head>
  <body>
   <nav class="navbar navbar-expand-lg corbarra">
    <div class="container-fluid">
      <button onclick="abrirmenu()" class="navbar-toggler" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#"> <i class="fa-solid fa-alarm-clock" style="color: rgb(255, 255, 255);"></i> Ecolote </a>
    </div>
  </nav>
  <div id="escurecer" class="escurecer" onclick="abrirmenu()"></div>
    
   <div class="container-fluid">
        <div class="row painel-admin">
            <div class="col-md-2 bg-dark coluna-sidebar">
                <aside id="sidebar" class="sidebar p-3 text-white bg-dark">
                    <h4> Meu painel </h4>
                    <h5> Bem-vindo(a) <?php echo $_SESSION['usuario']  ?>  </h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="./ecolote.php"><i class="fa-solid fa-user" style="color: white;"></i> Usuários</a></li>
                        <li class="nav-item"><a class="nav-link" href="./mercado.php"><i class="fa-solid fa-shop" style="color: white;"></i> Mercados</a></li>
                        <li class="nav-item"><a class="nav-link" href="./produto.php"><i class="fa-solid fa-basket-shopping" style="color: white;"></i> Produtos</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./receita.php"><i class="fa-solid fa-book-open" style="color: white;"></i> Receitas</a></li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-5">
              <form action="<?=$destino?>" method="post" enctype="multipart/form-data" class="p-3">
                <h3> <i class="fa-solid fa-circle-plus"></i> Cadastro de receita </h3>
                <input value="<?php echo isset($receitas) ? $receitas['id'] : "" ?>" type="hidden" name="id">
                <input value="<?php echo isset($receitas) ? $receitas['foto'] : "" ?>" type="hidden" name="foto_atual">
                <div class="mb-3">
                    <label class="form-label"> Nome da receita </label>
                    <input value="<?php echo isset($receitas) ? $receitas['nome'] : "" ?>" type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Foto </label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <?php if (!empty($receitas['foto'])) { ?>
                      <img src="<?= $receitas['foto'] ?>" class="preview-upload mt-2" alt="Foto da receita">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Descrição </label>
                    <textarea name="descricao" class="form-control" rows="5" required><?php echo isset($receitas) ? $receitas['descricao'] : "" ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary"> Cadastrar </button>
                <button type="reset" class="btn btn-secondary"> Limpar </button>
              </form>
            </div>
            <div class="col-md-5"> 
              <br>
              <h3> <i class="fa-solid fa-address-book"></i> Listagem </h3>
              <table class="table" id="tabela">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $dados = mysqli_query($conexao, 'SELECT * FROM receita ORDER BY nome');
                  while($coluna = mysqli_fetch_assoc($dados)){
                ?>
                <tr>
                  <th><?php echo $coluna['id'] ?></th>
                  <td><?php echo $coluna['nome'] ?></td>
                  <td><?php echo strlen($coluna['descricao']) > 70 ? substr($coluna['descricao'], 0, 70) . '...' : $coluna['descricao'] ?></td>
                  <td>
                    <a href="./receita.php?id=<?=$coluna['id']?>"><i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i></a> 
                    <a href="./backend/receita/excluir.php?id=<?=$coluna['id']?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fa-solid fa-trash" style="color: rgb(255, 0, 0);"></i></a> 
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
