<?php
include("conexao.php");

// Totais
$sql = "SELECT COUNT(*) as total_doacoes, SUM(valor) as total_valor FROM doacoes";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$total_doacoes = $row["total_doacoes"];
$total_valor = $row["total_valor"] ?? 0;

$sql = "SELECT COUNT(*) as total_doadores FROM doadores";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$total_doadores = $row["total_doadores"];

// Lista completa
$sql = "SELECT doacoes.*, doadores.nome
        FROM doacoes
        JOIN doadores ON doacoes.doador_id = doadores.id
        ORDER BY data DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Relatórios</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<header>
<h1>📊 Painel de Relatórios</h1>
</header>

<h2>Visão Geral do Sistema</h2>

<div class="cards">

  <div class="card">
    <h3>Total Arrecadado</h3>
    <p>R$ <?php echo number_format($total_valor, 2, ',', '.'); ?></p>
  </div>

  <div class="card">
    <h3>Total de Doações</h3>
    <p><?php echo $total_doacoes; ?></p>
  </div>

  <div class="card">
    <h3>Total de Doadores</h3>
    <p><?php echo $total_doadores; ?></p>
  </div>

</div>

<h2>Todas as Doações</h2>

<table>
  <thead>
    <tr>
      <th>Doador</th>
      <th>Tipo</th>
      <th>Descrição</th>
      <th>Valor</th>
      <th>Data</th>
    </tr>
  </thead>

  <tbody>
<?php
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["nome"] . "</td>";
    echo "<td>" . $row["tipo"] . "</td>";
    echo "<td>" . $row["descricao"] . "</td>";
    echo "<td>R$ " . number_format($row["valor"], 2, ',', '.') . "</td>";
    echo "<td>" . $row["data"] . "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='5'>Nenhuma doação cadastrada</td></tr>";
}
?>
  </tbody>
</table>

<br>
<a href="index.php" class="btn">⬅ Voltar</a>

</div>

</body>
</html>
