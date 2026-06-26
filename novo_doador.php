<?php 
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nome = $_POST["nome"] ?? "";
  $telefone = $_POST["telefone"] ?? "";
  $email = $_POST["email"] ?? "";

  if ($nome != "" && $telefone != "" && $email != "") {

      $sql = "INSERT INTO doadores (nome, telefone, email)
              VALUES ('$nome', '$telefone', '$email')";

      if ($conn->query($sql) === TRUE) {
          echo "Doador cadastrado com sucesso!";
      } else {
          echo "Erro: " . $conn->error;
      }
  }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novo Doador</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

            <h2>Cadastrar Doador</h2>

   <section>         
  <form method="POST">

  <label>Nome:</label><br>
  <input type="text" name="nome"><br><br>

  <label>Telefone:</label><br>
  <input type="text" name="telefone"><br><br>

  <label>Email:</label><br>
  <input type="email" name="email"><br><br>

  <button type="submit">Salvar</button>
  
  </form>
  </section>
  
</body>
</html>