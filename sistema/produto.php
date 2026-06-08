<?php
  include './backend/conexao.php';
  include './backend/validacao.php';

  //destino que o formulário enviará os dados
  $destino = "./backend/produto/inserir.php";
  
  //no caso de estar havendo alguma edição
  //carregará os dados do formulário e mandará para o arquivo alterar
  //Se for diferente de vazio o id
  if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM produto WHERE id='$id' ";
    //executar sql
    $dados = mysqli_query($conexao, $sql);
    $produtos = mysqli_fetch_assoc($dados);
    $receitasProduto = [];
    $dadosReceitasProduto = mysqli_query($conexao, "SELECT receita_id FROM produto_receita WHERE produto_id='$id'");
    while ($receitaProduto = mysqli_fetch_assoc($dadosReceitasProduto)) {
      $receitasProduto[] = $receitaProduto['receita_id'];
    }
    //destino será alterado, para o caminho do alterar
    $destino = "./backend/produto/alterar.php";
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
    

    <button onclick="abrirmenu()" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"> <i class="fa-solid fa-alarm-clock" style="color: rgb(255, 255, 255);"></i> Ecolote </a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Público</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      
      </ul>
     
    </div>
  </div>
</nav>
<div id="escurecer" class="escurecer" onclick="abrirmenu()"></div>
    
   <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark coluna-sidebar">
                <aside id="sidebar" class="sidebar p-3 text-white bg-dark">
                    <h4> Meu painel </h4>
                    
                    <h5> Bem-vindo(a) <?php echo $_SESSION['usuario']  ?>  </h5>
                    <ul class="nav flex-column">

                        <li class="nav-item"> 
                            <a class="nav-link" href="./ecolote.php"> <i class="fa-solid fa-user" style="color: rgb(255, 255, 255);"></i> Usuários</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="./mercado.php"> <i class="fa-solid fa-shop" style="color: rgb(255, 255, 255);"></i> Mercados</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="./produto.php"> <i class="fa-solid fa-basket-shopping" style="color: rgb(255, 255, 255);"></i> Produtos</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="./receita.php"> <i class="fa-solid fa-book-open" style="color: rgb(255, 255, 255);"></i> Receitas</a>
                        </li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-5">
              <form action="<?=$destino?>" method="post" enctype="multipart/form-data" class="p-3">
                <h3> <i class="fa-solid fa-circle-plus"></i> Cadastro de produto </h3>
                 <div class="mb-3">
                    <label class="form-label"> id </label>
                    <input value="<?php echo isset($produtos) ? $produtos['id'] : "" ?>" type="text" name="id" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Nome do produto </label>
                    <input value="<?php echo isset($produtos) ? $produtos['nome'] : "" ?>" type="text" name="nome" class="form-control">
                </div>
                 <div class="mb-3">
                    <label class="form-label"> Preço </label>
                    <input value="<?php echo isset($produtos) ? $produtos['preco'] : "" ?>" type="text" name="preco" class="form-control mascara-preco">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Disponibilidade </label>
                    <input value="<?php echo isset($produtos) ? $produtos['disponibilidade'] : "" ?>" type="text" name="disponibilidade" class="form-control">
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
                    <label class="form-label"> Mercado </label> 
                    <select name="mercado" class="form-select"> 
                      <option> Selecione uma opção </option>
                      <?php 
                        $busca = mysqli_query($conexao, "SELECT * FROM mercado");

                        while($mercado = $busca->fetch_assoc()) {
                          
                        
                      ?>
                      <option value="<?=$mercado['id']?>" <?php echo (isset($produtos) && $produtos['mercado_id'] == $mercado['id']) ? 'selected' : '' ?>> <?= $mercado['nome'] ?> </option> 

                      <?php  }?>
                     </select> 
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
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Preço</th>
                  <th scope="col">Disponibilidade</th>
                  <th scope="col">Mercado id</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $sql = 'SELECT * FROM produto';
                  $dados = mysqli_query($conexao, $sql);
                  //percoorer todos os registros banco
                  while($coluna = mysqli_fetch_assoc($dados)){
                ?>

                <tr>
                  <th scope="row"> <?php echo $coluna['id'] ?> </th>
                  <td> <?php echo $coluna['nome'] ?></td>
                  <td> <?php echo $coluna['preco'] ?></td>
                  <td> <?php echo $coluna['disponibilidade'] ?></td>
                  <td> 
                  <?php 
                    $buscaMercado = mysqli_query ($conexao, "SELECT * FROM mercado WHERE id=".$coluna['mercado_id']);
                    $mercado = mysqli_fetch_assoc($buscaMercado);
                    echo $mercado['id'];
                    echo " - ";
                    echo $mercado['nome'];
                  ?></td>
                  <td>
                    <a href="./produto.php?id=<?=$coluna['id']?>"> <i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i> </a> 
                    <a href="<?php echo './backend/produto/excluir.php?id='.$coluna['id'] ?>" onclick="return confirm('Deseja realmente excluir?')"> <i class="fa-solid fa-trash" style="color: rgb(255, 0, 0);"></i> </a> 
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div>
        </div>

   </div>
   

   <script>
        function abrirmenu(){
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('escurecer').classList.toggle('show');
        }
   </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="assets/script.js"></script>

</body>
</html>
