<?php
include "menu.php";
$idfornecedor = isset($_GET["idfornecedor"]) ? $_GET["idfornecedor"]:null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

    if($idfornecedor){
      //estou buscando os dados do cliente no BD
      $sql = "SELECT * FROM  tblfornecedores where idfornecedor= :idfornecedor";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idfornecedor",$idfornecedor);
      $stmt->execute();
      $fornecedor = $stmt->fetch(PDO::FETCH_OBJ);
      //var_dump($cliente);
  }
    

    if ($op=="del") {
      $sql = "DELETE from tblfornecedores where ididfornecedor= :ididfornecedor";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idfornecedor",$idfornecedor);
      $stmt->execute();
      header("Location:fornecedores.php");
    }

    if ($_POST) {
      if ($_POST["idfornecedor"]) {
        $sql = "UPDATE tblfornecedores set fornecedor=:fornecedor,caracteristica=:caracteristica,email=:email,cel=:cel where idfornecedor=:idfornecedor ";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":fornecedor", $_POST["fornecedor"]);
        $stmt->bindValue(":caracteristica",$_POST["caracteristica"]);
        $stmt->bindValue(":qtd",$_POST["qtd"]);
        $stmt->bindValue(":inicontr",$_POST["inicontr"]);
        $stmt->bindValue(":idfornecedor",$_POST["idfornecedor"]);
        $stmt->execute();
      } else {
        $sql = "INSERT into tblfornecedores(fornecedor,caracteristica,qtd,inicontr) values(:fornecedor,:caracteristica,:qtd,:inicontr)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":fornecedor",$_POST["fornecedor"]);
        $stmt->bindValue(":caracteristica",$_POST["caracteristica"]);
        $stmt->bindValue(":qtd",$_POST["qtd"]);
        $stmt->bindValue(":inicontr",$_POST["inicontr"]);
        
        $stmt->execute();
      }
      header("Location:fornecedores.php");
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
      <h1>Cadastro de Fornecedor</h1>

      <div class="container">
        <form method="post">
            <br>
            <br>
            <label for="">Fornecedor</label>
            <input name="fornecedor" value="<?php echo isset($fornecedor) ? $fornecedor->fornecedor : null ?>"type="text">
            <br>
            <br>
            <label for="">Caracteristica</label>
            <input name="caracteristica" value="<?php echo isset($fornecedor) ? $fornecedor->caracteristica : null ?>"type="text">
            <br>
            <br>
            <label for="">Quantidade</label>
            <input name="qtd" value="<?php echo isset($fornecedor) ? $fornecedor->qtd : null ?>"type="text">
            <br>
            <br>
            <label for="">Inicio de Contrato</label>
            <input name="inicontr" value="<?php echo isset($fornecedor) ? $fornecedor->inicontr : null ?>"type="date">
            <br>
            <br>
            <input type="hidden"     name="idfornecedor"   value="<?php echo isset($fornecedor) ? $fornecedor->idfornecedor : null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-outline-success">


        </form>
      </div>

      
    


  
  <?php 
    
    include "rodape.php";
    ?>
