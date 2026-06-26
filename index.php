<?php 
include("conexao.php");

$sql = "SELECT COUNT(*) as total_doacoes FROM doacoes";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_doacoes = $row["total_doacoes"];
$total_dinheiro = 0;

$sql = "SELECT COUNT(*) as total_doadores FROM doadores";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_doadores = $row["total_doadores"];

$sql = "SELECT SUM(valor) as total FROM doacoes";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_dinheiro = $row["total"] ?? 0;

$sql = "SELECT doacoes.*, doadores.nome
        FROM doacoes
        JOIN doadores ON doacoes.doador_id = doadores.id
        ORDER BY doacoes.id DESC
        LIMIT 5";

$result_doacoes = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projeto Cestar</title>
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <div class="container">
     <!--     <h1>Conectado com sucesso</h1>
  Título -->
  <header>
              <h1>Projeto Cestar</h1>
  </header>
  <!--Cards -->
  <section>            
    <div class="cards">
      <div class="card">
        <h3>Total Arrecadado</h3>
        <p>R$ <?php echo $total_dinheiro; ?></p>
      </div>

      <div class="card">
        <h3>Total Doações</h3>
        <p><p><?php echo $total_doacoes; ?></p>
        </p>
      </div>

      <div class="card">
        <h3>Total de Doadores</h3>
        <p><?php echo $total_doadores; ?></p>
      </div>

  </div>
  </section>

 <!--botões -->
  <section class="acoes">
      <a href="nova_doacao.php" class="btn">Nova doação</a>
      <a href="doadores.php" class="btn">Novo doador</a>
      <a href="relatorios.php" class="btn">Relatórios</a>
 </section> 

              <h2>Últimas Doações</h2>
  <!--Tabela -->
  <section>
      <table>
        <thead>
          <tr>
            <th>Doador</th>
            <th>Doação</th>
            <th>Valor</th>
            <th>Data</th>
          </tr>
        </thead>

        <tbody>
<?php
if ($result_doacoes->num_rows > 0){
    while($row = $result_doacoes->fetch_assoc()){
      echo "<tr>";
      echo "<td>" . $row["nome"] . "</td>";
      echo "<td>" . $row["tipo"] . " - " . $row["descricao"] . "</td>";
      echo "<td>R$ " . number_format($row["valor"], 2, ',', '.') . "</td>";
      echo "<td>" . $row["data"] . "</td>";
      echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nenhuma doação cadastrada</td></tr>";
}
?>
        </tbody>

      </table>
  </section>

     
  <script src="cestar.js"></script>
</div>  
</body>
</html>