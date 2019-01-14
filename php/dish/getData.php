<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $statement = $connection->prepare("SELECT * FROM categoria ORDER BY nome");
  $statement->execute();
  $result = $statement->get_result();
  checkError($result === false, "SERVER", "QUERY", $connection->error);
  $statement->close();
  while($row = $result->fetch_assoc())
    $output["categories"][$row["nome"]] = $row["idCategoria"];

  $statement = $connection->prepare("SELECT * FROM ingrediente ORDER BY nome");
  $statement->execute();
  $result = $statement->get_result();
  checkError($result === false, "SERVER", "QUERY", $connection->error);
  $statement->close();
  while($row = $result->fetch_assoc())
    $output["ingredients"][$row["nome"]] = $row["idIngrediente"];

  $connection->close();
  closeWithoutErrors($output);
?>
