<?php
include "conexao.php";
include "menu.php";

try{
    $sql = "SELECT * FROM tblfuncionarios";
    $qry = $con->query($sql);
    $funcionarios = $qry->fetchALL(PDO::FETCH_OBJ);

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
    <h1>Funcionarios cadastrados</h1>
<hr>

<div class="container">
    <a href="frmfuncionario.php" class="btn btn-primary">Novo</a>
    <br>
    <br>
    <table class="table table-secondary table-striped table-hover">
        <thead>
            <tr>
                <th>idfuncionario</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Cel</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($funcionarios as $funcionario) { ?>
            <tr>
                <th><?php echo $funcionario->idfuncionario ?></th>
                <th><?php echo $funcionario->nome ?></th>
                <th><?php echo $funcionario->cpf ?></th>
                <th><?php echo $funcionario->email ?></th>
                <th><?php echo $funcionario->cel ?></th>
                
                <th > <a class="btn btn-outline-warning" href="frmfuncionario.php?idfuncionario=<?php echo $funcionario->idfuncionario ?>">
                <img src="./img/editar.png" alt="">
                </a> </th>
                <th > <a class="btn btn-outline-danger" href="frmfuncionario.php?op=del&idfuncionario=<?php echo $funcionario->idfuncionario ?>">
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