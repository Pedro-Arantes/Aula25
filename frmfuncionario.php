<?php
include "menu.php";
$idfuncionario = isset($_GET["idfuncionario"]) ? $_GET["idfuncionario"]:null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

    if($idfuncionario){
      //estou buscando os dados do cliente no BD
      $sql = "SELECT * FROM  tblfuncionarios where idfuncionario= :idfuncionario";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idfuncionario",$idfuncionario);
      $stmt->execute();
      $funcionario = $stmt->fetch(PDO::FETCH_OBJ);
      //var_dump($cliente);
  }
    

    if ($op=="del") {
      $sql = "DELETE from tblfuncionarios where idfuncionario= :idfuncionario";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":idfuncionario",$idfuncionario);
      $stmt->execute();
      header("Location:funcionarios.php");
    }

    if ($_POST) {
      if ($_POST["idfuncionario"]) {
        $sql = "UPDATE tblfuncionarios set nome=:nome,cpf=:cpf,email=:email,cel=:cel where idfuncionario=:idfuncionario ";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":nome", $_POST["nome"]);
        $stmt->bindValue(":cpf",$_POST["cpf"]);
        $stmt->bindValue(":email",$_POST["email"]);
        $stmt->bindValue(":cel",$_POST["cel"]);
        $stmt->bindValue(":idfuncionario",$_POST["idfuncionario"]);
        $stmt->execute();
      } else {
        $sql = "INSERT into tblfuncionarios(nome,cpf,email,cel) values(:nome,:cpf,:email,:cel)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":nome",$_POST["nome"]);
        $stmt->bindValue(":cpf",$_POST["cpf"]);
        $stmt->bindValue(":email",$_POST["email"]);
        $stmt->bindValue(":cel",$_POST["cel"]);
        
        $stmt->execute();
      }
      header("Location:funcionarios.php");
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
      <h1>Cadastro de Funcionário</h1>

      <div class="container">
        <form method="post">
            <br>
            <br>
            <label for="">Nome</label>
            <input name="nome" value="<?php echo isset($funcionario) ? $funcionario->nome : null ?>"type="text">
            <br>
            <br>
            <label for="">CPF</label>
            <input name="cpf" value="<?php echo isset($funcionario) ? $funcionario->cpf : null ?>"type="text">
            <br>
            <br>
            <label for="">Email</label>
            <input name="email" value="<?php echo isset($funcionario) ? $funcionario->email : null ?>"type="email">
            <br>
            <br>
            <label for="">Celular</label>
            <input name="cel" value="<?php echo isset($funcionario) ? $funcionario->cel : null ?>"type="text">
            <br>
            <br>
            <input type="hidden"     name="idfuncionario"   value="<?php echo isset($funcinario) ? $funcionario->idfuncionario : null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-outline-success">


        </form>
      </div>

      
    


  
  <?php 
    
    include "rodape.php";
    ?>