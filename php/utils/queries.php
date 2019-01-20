<?php
  require_once "errors.php";

  function getResult($args, $query) {
    $connection = new mysqli("localhost", "root", "", "almafood");
    checkError($connection->connect_error, "SERVER", "CONNECTION", $connection->connect_error);
    $statement = $connection->prepare($query);
    // bind params code to be evaluated with "eval"
    if (count($args) > 0) {
      $code = '$statement->bind_param(';
      $code .= '"' . str_repeat('s', count($args)) . '"';
      for ($i = 0; $i < count($args); $i++)
        $code .= ', $args[' . $i . ']';
      $code .= ');';
      eval($code);
    }
    checkError($statement->execute() === false, "SERVER", "QUERY", $connection->error);
    // switch modes (SELECT, INSERT, UPDATE, DELETE)
    switch ($query[0]) {
      case "S":
        $result = $statement->get_result();
        checkError($result === false, "SERVER", "QUERY", $connection->error);
        break;
      case "I":
        $result = $statement->insert_id;
        break;
      default:
        $result = "";
        break;
    }
    $statement->close();
    $connection->close();
    return $result;
  }

  function getUserData($email, $username) {
    foreach (array("cliente", "fornitore") as $table) {
      $result = getResult(func_get_args(), "SELECT * FROM $table WHERE email = ? OR username = ?");
      if ($data = $result->fetch_assoc())
        return $data;
    }
  }

  function insertClient($email, $username, $password, $name, $surname) {
    getResult(func_get_args(), "INSERT INTO cliente(email, username, password, nome, cognome) VALUES (?, ?, ?, ?, ?)");
  }

  function insertVendor($email, $username, $password, $restaurant) {
    getResult(func_get_args(), "INSERT INTO fornitore(email, username, password, ristorante) VALUES (?, ?, ?, ?)");
  }

  function getAllCategories() {
    $result = getResult(func_get_args(), "SELECT * FROM categoria ORDER BY nome");
    while($row = $result->fetch_assoc())
      $data[$row["nome"]] = $row["idCategoria"];
    return $data;
  }

  function getAllIngredients() {
    $result = getResult(func_get_args(), "SELECT * FROM ingrediente ORDER BY nome");
    while($row = $result->fetch_assoc())
      $data[$row["nome"]] = $row["idIngrediente"];
    return $data;
  }

  function getAllVendors() {
    $result = getResult(func_get_args(), "SELECT username, ristorante, qual_sum, qual_tot, prez_sum, prez_tot FROM fornitore");
    while($row = $result->fetch_assoc()) {
      $data[$row["username"]]["name"] = $row["ristorante"];
      $data[$row["username"]]["quality"] = $row["qual_tot"] == 0 ? 0 : $row["qual_sum"] / $row["qual_tot"];
      $data[$row["username"]]["price"] = $row["prez_tot"] == 0 ? 0 : $row["prez_sum"] / $row["prez_tot"];
    }
    return $data;
  }

  function getVendorUserFromName($restName) {
    $result = getResult(func_get_args(), "SELECT fornitore.username FROM fornitore WHERE fornitore.ristorante = ?");
    $row = $result->fetch_assoc();
    return $row["username"];
  }

  function getCategoriesFromVendor($vendor) {
    $result = getResult(func_get_args(), "SELECT C.nome
                                          FROM pietanza P, categoria C
                                          WHERE P.forn_user = ?
                                          AND P.idCategoria = C.idCategoria
                                          GROUP BY P.idCategoria
                                          ORDER BY COUNT(*)");
    $data = array();
    while($row = $result->fetch_assoc())
      $data[] = $row["nome"];
    return $data;
  }

  function getMenuCategories($username) {
    $result = getResult(func_get_args(), "SELECT DISTINCT categoria.nome, categoria.idCategoria
                                          FROM pietanza, categoria
                                          WHERE categoria.idCategoria = pietanza.idCategoria
                                          AND pietanza.forn_user = ?");
    while ($row = $result->fetch_assoc())
     $data[] = $row;
    return $data;
  }

  function getMenuDishes($username, $categoryId) {
    $result = getResult(func_get_args(), "SELECT pietanza.nome, pietanza.costo, pietanza.idPietanza
                                          FROM pietanza
                                          WHERE pietanza.forn_user = ?
                                          AND pietanza.idCategoria = ?");
    while ($row = $result->fetch_assoc())
     $data[] = $row;
    return $data;
  }

  function getDishIngredients($dishId) {
    $result = getResult(func_get_args(), "SELECT ingrediente.nome
                                          FROM ingrediente, composizione
                                          WHERE ingrediente.idIngrediente = composizione.idIngrediente
                                          AND composizione.idPietanza = ?");
    while ($row = $result->fetch_assoc())
     $data[] = $row;
    return $data;
  }

  function getDishIngredientsNames($dishId) {
    $result = getDishIngredients($dishId);
    foreach ($result as $key) {
      $data[] = $key["nome"];
    }
    return $data;
  }

  function getDishInfo($dishId) {
    $result = getResult(func_get_args(), "SELECT pietanza.nome, pietanza.costo, pietanza.idCategoria
                                          FROM pietanza
                                          WHERE pietanza.idPietanza = ?");

    return $result->fetch_assoc();
  }

  function deleteDish($dishId) {
    getResult(func_get_args(), "DELETE p, c
                                FROM pietanza p INNER JOIN composizione c ON p.idPietanza = c.idPietanza
                                WHERE p.idPietanza = ?");
  }

  function insertDish($name, $price, $category, $username) {
    return getResult(func_get_args(), "INSERT INTO pietanza(nome, costo, idCategoria, forn_user) VALUES (?, ?, ?, ?)");
  }

  function updateDish($name, $price, $category, $dishId) {
    getResult(func_get_args(), "UPDATE pietanza SET nome = ?, costo = ?, idCategoria = ?  WHERE idPietanza = ?");
  }

  function bindIngredientWithDish($ingredientId, $dishId) {
    getResult(func_get_args(), "INSERT INTO composizione(idIngrediente, idPietanza) VALUES (?, ?)");
  }

  function deleteBind($dishId) {
    getResult(func_get_args(), "DELETE c FROM composizione c WHERE c.idPietanza = ?");
  }

  function getOrdersFrom($username, $tipo) {
    $result = getResult(array($username), $tipo === "cliente" ?
                                          "SELECT fornitore.ristorante AS nominativo,
                                                  ordine.idOrdine AS ordine,
                                                  ordine.costoTot AS costo,
                                                  ordine.dataora AS oraConsegna,
                                                  aula.nome AS aula
                                           FROM ordine, fornitore, aula
                                           WHERE ordine.forn_user = fornitore.username
                                           AND ordine.idAula = aula.idAula
                                           AND ordine.idStato = 1
                                           AND ordine.cli_user = ?
                                           ORDER BY ordine.dataora ASC" :
                                          "SELECT CONCAT(cliente.nome, ' ', cliente.cognome) AS nominativo,
                                                  ordine.idOrdine AS ordine,
                                                  ordine.costoTot AS costo,
                                                  ordine.dataora AS oraConsegna,
                                                  aula.nome AS aula
                                           FROM ordine, cliente, aula
                                           WHERE ordine.cli_user = cliente.username
                                           AND ordine.idAula = aula.idAula
                                           AND ordine.idStato = 1
                                           AND ordine.forn_user = ?
                                           ORDER BY ordine.dataora ASC");
    while ($row = $result->fetch_assoc())
      $data[] = $row;
    return $data;
  }

  function getDishesInOrder($orderId) {
    $result = getResult(func_get_args(), "SELECT CONCAT(pietanza.nome, ' (x', pietanza_in_ordine.quantita, ')') AS pietanza
                                          FROM pietanza_in_ordine, pietanza
                                          WHERE pietanza_in_ordine.idPietanza = pietanza.idPietanza
                                          AND idOrdine = ?");
    while($row = $result->fetch_assoc())
      $data[] = $row;
    return $data;
  }

  function changeOrderState($newState, $orderId) {
    getResult(func_get_args(), "UPDATE ordine SET idStato = ? WHERE idOrdine = ?");
  }
?>
