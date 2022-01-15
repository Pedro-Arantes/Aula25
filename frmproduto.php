<?php
include "menu.php";
$idproduto = isset($_GET["idproduto"]) ? $_GET["idproduto"]:null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

    if($idproduto){
      //estou buscando os dados do cliente no BD
      $sql = "SELECT * FROM  tblprodutos where idproduto= :idproduto";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idproduto",$idproduto);
      $stmt->execute();
      $funcionario = $stmt->fetch(PDO::FETCH_OBJ);
      //var_dump($cliente);
  }
    

    if ($op=="del") {
      $sql = "DELETE from tblprodutos where idproduto= :idproduto";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idproduto",$idproduto);
      $stmt->execute();
      header("Location:produtos.php");
    }

    if ($_POST) {
      if ($_POST["idproduto"]) {
        $sql = "UPDATE tblprodutos set produto=:produto,valor=:valor,estoque=:estoque,estoquemax=:estoquemax,estoquemin=:estoquemin where idproduto=:idproduto ";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":produto", $_POST["produto"]);
        $stmt->bindValue(":valor",$_POST["valor"]);
        $stmt->bindValue(":estoque",$_POST["estoque"]);
        $stmt->bindValue(":estoquemax",$_POST["estoquemax"]);
        $stmt->bindValue(":estoquemin",$_POST["estoquemin"]);
        $stmt->bindValue(":idproduto",$_POST["idproduto"]);
        $stmt->execute();
      } else {
        $sql = "INSERT into tblprodutos(produto,valor,estoque,estoquemax,estoquemin) values(:produto,:valor,:estoque,:estoquemax,:estoquemin)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":produto",$_POST["produto"]);
        $stmt->bindValue(":valor",$_POST["valor"]);
        $stmt->bindValue(":estoque",$_POST["estoque"]);
        $stmt->bindValue(":estoquemax",$_POST["estoquemax"]);
        $stmt->bindValue(":estoquemin",$_POST["estoquemin"]);
        
        $stmt->execute();
      }
      header("Location:produtos.php");
    }
} catch (PDOException $e) {
    echo "Erro: ".$e->getMessage();
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
      <h1>Cadastro de Produtos</h1>

      <div class="container">
        <form method="post">
            <br>
            <br>
            <label for="">Produto</label>
            <input name="produto" value="<?php echo isset($produto) ? $produto->produto : null ?>"type="text">
            <br>
            <br>
            <label for="">Valor</label>
            <input name="valor" value="<?php echo isset($produto) ? $produto->valor : null ?>"type="text">
            <br>
            <br>
            <label for="">Estoque</label>
            <input name="estoque" value="<?php echo isset($produto) ? $produto->estoque : null ?>"type="text">
            <br>
            <br>
            <label for="">Estoque Maximo</label>
            <input name="estoquemax" value="<?php echo isset($produto) ? $produto->estoquemax : null ?>"type="text">
            <br>
            <br>
            <label for="">Estoque Mínimo</label>
            <input name="estoquemin" value="<?php echo isset($produto) ? $produto->estoquemin : null ?>"type="text">
            <br>
            <br>
            <input type="hidden"     name="idproduto"   value="<?php echo isset($produto) ? $produto->idproduto : null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-outline-success">


        </form>
      </div>

      
    


  
  <?php 
    
    include "rodape.php";
    ?>