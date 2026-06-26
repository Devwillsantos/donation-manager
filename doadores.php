<?php
include("conexao.php");

// CADASTRAR DOADOR
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"] ?? "";
  $telefone = $_POST["telefone"] ?? "";
  $email = $_POST["email"] ?? "";

  if ($nome != "") {
    $sql = "INSERT INTO doadores (nome, telefone, email)
            VALUES ('$nome', '$telefone', '$email')";
    
    if ($conn->query($sql) === TRUE) {
      header("Location: doadores.php?sucesso=1");
      exit;
    } else {
      echo "Erro: " . $conn->error;
    }
  }
}

// LISTAR DOADORES
$sql = "SELECT * FROM doadores ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Doadores</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<header>
  <h1>Doadores</h1>
</header>

<h2>Cadastrar Novo Doador</h2>

<?php
if (isset($_GET["sucesso"])) {
  echo "<p style='color:green;'>Doador cadastrado com sucesso!</p>";
}
?>
<section>
<form method="POST">

<label>Nome:</label>
<input type="text" name="nome" required>

<label>Telefone:</label>
<input type="text" name="telefone">

<label>Email:</label>
<input type="email" name="email">

<button type="submit" class="btn">Salvar</button>

</form>
</section>

<h2>Lista de Doadores</h2>

<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Telefone</th>
      <th>Email</th>
    </tr>
  </thead>

  <tbody>
  <?php
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["nome"] . "</td>";
      echo "<td>" . $row["telefone"] . "</td>";
      echo "<td>" . $row["email"] . "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='3'>Nenhum doador cadastrado</td></tr>";
  }
  ?>
  </tbody>
</table>

<br>
<a href="index.php" class="btn">⬅ Voltar</a>

</div>

</body>
</html>
