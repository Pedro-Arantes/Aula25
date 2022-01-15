<?php
include "menu.php";
$idcliente = isset($_GET["idcliente"]) ? $_GET["idcliente"]:null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

    if($idcliente){
      //estou buscando os dados do cliente no BD
      $sql = "SELECT * FROM  tblclientes where idcliente= :idcliente";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idcliente",$idcliente);
      $stmt->execute();
      $cliente = $stmt->fetch(PDO::FETCH_OBJ);
      //var_dump($cliente);
  }
    

    if ($op=="del") {
      $sql = "delete from tblclientes where idcliente= :idcliente";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idcliente",$idcliente);
      $stmt->execute();
      header("Location:clientes.php");
    }

    if ($_POST) {
      if ($_POST["idcliente"]) {
        $sql = "UPDATE tblclientes set cliente=:cliente,dtcad=:dtcad,valor=:valor where idcliente=:idcliente ";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":cliente", $_POST["cliente"]);
        $stmt->bindValue(":dtcad",$_POST["dtcad"]);
        $stmt->bindValue(":valor",$_POST["valor"]);
        $stmt->bindValue(":idcliente",$_POST["idcliente"]);
        $stmt->execute();
      } else {
        $sql = "INSERT into tblclientes(cliente,dtcad,valor) values(:cliente,:dtcad,:valor)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":cliente",$_POST["cliente"]);
        $stmt->bindValue(":dtcad",$_POST["dtcad"]);
        $stmt->bindValue(":valor",$_POST["valor"]);
        
        $stmt->execute();
      }
      header("Location:clientes.php");
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
      <h1>Cadastro de Cliente</h1>

      <div class="container">
        <form method="post">
            <br>
            <br>
            <label for="">Cliente</label>
            <input name="cliente" value="<?php echo isset($cliente) ? $cliente->cliente : null ?>"type="text">
            <br>
            <br>
            <label for="">Data de cadastro</label>
            <input name="dtcad" value="<?php echo isset($cliente) ? $cliente->dtcad : null ?>" type="date">
            <br>
            <br>
            <label for="">Valor</label>
            <input name="valor" value="<?php echo isset($cliente) ? $cliente->valor : null ?>" type="text">
            <br>
            <br>
            <input type="hidden"     name="idcliente"   value="<?php echo isset($cliente) ? $cliente->idcliente : null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-outline-success">


        </form>
      </div>

      
    


  
  <?php 
    
    include "rodape.php";
    ?>

    
  