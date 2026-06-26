<?php
include("conexao.php");

// Buscar doadores
$sql_doador = "SELECT * FROM doadores";
$result = $conn->query($sql_doador);

// Processar formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $doador_id = $_POST["doador_id"] ?? "";
  $tipo = $_POST["tipo"] ?? "";
  $descricao = $_POST["descricao"] ?? "";
  $data = $_POST["data"] ?? "";
  $valor = $_POST["valor"] ?? "";

  if ($doador_id != "" && $tipo != "" && $descricao != "" && $data != "") {

      $sql = "INSERT INTO doacoes (doador_id, tipo, descricao, data, valor)
              VALUES ('$doador_id', '$tipo', '$descricao', '$data', '$valor')";

      if ($conn->query($sql) === TRUE) {
        header("Location: nova_doacao.php?sucesso=1");
        exit;
      } else {
        echo "Erro: " . $conn->error;
      }

  } else {
      echo "<p style='color:red;'>Preencha todos os campos!</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Doação</title>

  <!-- CSS DO SISTEMA -->
  <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

<header>
  <h1>Nova Doação</h1>
</header>

<h2>Cadastro de Doação</h2>

<?php
if (isset($_GET["sucesso"])) {
    echo "<p style='color:green; font-weight:bold;'>Doação cadastrada com sucesso!</p>";
}
?>

<section>

<form method="POST">

<label>Doador:</label><br>
<select name="doador_id" required>
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
    }
} else {
    echo "<option>Nenhum doador cadastrado</option>";
}
?>
</select><br><br>

<label>Tipo:</label><br>
<input type="text" name="tipo" required><br><br>

<label>Descrição:</label><br>
<input type="text" name="descricao" required><br><br>

<label>Data:</label><br>
<input type="date" name="data" required><br><br>

<label>Valor (R$):</label><br>
<input type="number" name="valor" step="0.01" required><br><br>

<button type="submit" class="btn">Salvar</button>

</form>

<br>

<a href="index.php" class="btn">⬅ Voltar</a>

</section>

</div>

</body>
</html>
