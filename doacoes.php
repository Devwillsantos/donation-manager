<?php
include("conexao.php");

$sql = "SELECT doacoes.*, doadores.nome 
        FROM doacoes 
        JOIN doadores ON doacoes.doador_id = doadores.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doacções</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
             <h2>Lista de Doações</h2>

  <table border="1">
    <tr>
      <th>Doador</th>
      <th>Tipo</th>
      <th>Descrição</th>
      <th>Data</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["nome"] . "</td>";
      echo "<td>" . $row["tipo"] . "</td>";
      echo "<td>" . $row["descricao"] . "</td>";
      echo "<td>" . $row["data"] . "</td>";
      echo "</tr>";
    }
} else {
  echo "<tr><td colspan='4'>Nenhuma doação cadastrada</td></tr>";

}

?>
  </table>

</body>
</html>