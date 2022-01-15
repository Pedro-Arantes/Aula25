<?php
include "conexao.php";
include "menu.php";

try{
    $sql = "SELECT * FROM tblprodutos";
    $qry = $con->query($sql);
    $produtos = $qry->fetchALL(PDO::FETCH_OBJ);

    //echo "<pre>";
    //    print_r($clientes);
       
} catch(PDOException $e){
    echo $e->getMessage();
}


?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sistema</title>
  </head>
  <body>
    <h1>Produtos cadastrados</h1>
<hr>

<div class="container">
    <a href="frmproduto.php" class="btn btn-outline-primary">Novo</a>
    <br> <br>
    <table class="table table-danger table-striped table-hover">
        <thead>
            <tr>
                <th>idproduto</th>
                <th>Produto</th>
                
                <th>Valor</th>
                <th>Estoque</th>
                <th>Estoque maximo</th>
                <th>Estoque mínimo</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($produtos as $produto) { ?>
            <tr>
                <th><?php echo $produto->idproduto ?></th>
                <th><?php echo $produto->produto ?></th>
                
                <th><?php echo $produto->valor ?></th>
                <th><?php echo $produto->estoque ?></th>
                <th><?php echo $produto->estoquemax ?></th>
                <th><?php echo $produto->estoquemin ?></th>

                <th > <a class="btn btn-outline-warning" href="frmproduto.php?idproduto=<?php echo $produto->idproduto ?>">
                <img src="./img/editar.png" alt="">
                </a> </th>

                <th > <a class="btn btn-outline-danger" href="frmproduto.php?op=del&idproduto=<?php echo $produto->idproduto ?>">
                <img src="./img/deletar.png" alt="">
                </a> </th> 
            </tr>
            <?php } ?>
            </tbody>
           

    </table>
</div>

    <?php 
    
    include "rodape.php";
    ?>