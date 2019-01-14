<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $statement = $connection->prepare("INSERT INTO pietanza(nome, costo, idCategoria, forn_user) VALUES (?, ?, ?, ?)");
  $statement->bind_param("ssss", $_POST["name"], $_POST["price"], $_POST["category"], $_SESSION["username"]);
  checkError($statement->execute() === false, "SERVER", "QUERY", $connection->error);
  $dishID = $statement->insert_id;
  $statement->close();

  $statement = $connection->prepare("INSERT INTO composizione(idIngrediente, idPietanza) VALUES (?, ?)");
  if (isset($_POST["ingredients"]))
    foreach($_POST["ingredients"] as $ingredientID) {
      $statement->bind_param("ss", $ingredientID, $dishID);
      checkError($statement->execute() === false, "SERVER", "QUERY", $connection->error);
    }
  $statement->close();

  $connection->close();
  closeWithoutErrors(array());
?>
