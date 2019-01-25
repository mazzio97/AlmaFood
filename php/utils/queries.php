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

  function insertOrder($dateTime, $totalPrice, $placeId, $cli_user, $vendor_user) {
    return getResult(func_get_args(), "INSERT INTO ordine(dataora, costoTot, idAula, cli_user, forn_user) VALUES (?, ?, ?, ?, ?)");
  }

  function getAllCategories() {
    $result = getResult(func_get_args(), "SELECT * FROM categoria ORDER BY nome");
    $data = array();
    while($row = $result->fetch_assoc())
      $data[$row["nome"]] = $row["idCategoria"];
    return $data;
  }

  function getAllIngredients() {
    $result = getResult(func_get_args(), "SELECT * FROM ingrediente ORDER BY nome");
    $data = array();
    while($row = $result->fetch_assoc())
      $data[$row["nome"]] = $row["idIngrediente"];
    return $data;
  }

  function getAllVendors() {
    $result = getResult(func_get_args(), "SELECT username, ristorante, abilitato, qual_sum, qual_tot, prez_sum, prez_tot
                                          FROM fornitore");
    $data = array();
    while($row = $result->fetch_assoc()) {
      $data[$row["username"]]["username"] = $row["username"];
      $data[$row["username"]]["name"] = $row["ristorante"];
      $data[$row["username"]]["enabled"] = $row["abilitato"];
      $data[$row["username"]]["quality"] = $row["qual_tot"] == 0 ? 0 : $row["qual_sum"] / $row["qual_tot"];
      $data[$row["username"]]["price"] = $row["prez_tot"] == 0 ? 0 : $row["prez_sum"] / $row["prez_tot"];
    }
    return $data;
  }
  function getAllPlaces() {
    $result = getResult(func_get_args(), "SELECT * FROM aula ORDER BY nome");
    $data = array();
    while($row = $result->fetch_assoc())
      $data[$row["nome"]] = $row["idAula"];
    return $data;
  }

  function getOrderDetails($orderId) {
    $orderDetails = array("restaurant" => "", "dishes" => array());
    $result = getResult(func_get_args(), "SELECT forn_user
                                          FROM ordine
                                          WHERE idOrdine = ?");
    $row = $result->fetch_assoc();
    $orderDetails["restaurant"] = $row["forn_user"];
    $result = getResult(func_get_args(), "SELECT PO.idPietanza, P.nome, PO.quantita, P.costo
                                          FROM pietanza_in_ordine PO, pietanza P
                                          WHERE PO.idPietanza = P.idPietanza
                                          AND PO.idOrdine = ?");
    while($row = $result->fetch_assoc())
      $orderDetails["dishes"][] = $row;
    return $orderDetails;
  }

  function getVendorFromUsername($username) {
    $result = getResult(func_get_args(), "SELECT * FROM fornitore WHERE fornitore.username = ?");
    return $result->fetch_assoc();
  }

  function getVendorFromOrder($orderId) {
    $result = getResult(func_get_args(), "SELECT fornitore.*
                                          FROM fornitore, ordine
                                          WHERE fornitore.username = ordine.forn_user
                                          AND ordine.idOrdine = ?");
    return $result->fetch_assoc();
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
    $data = array();
    while ($row = $result->fetch_assoc())
     $data[] = $row;
    return $data;
  }

  function getMenuDishes($username, $categoryId) {
    $result = getResult(func_get_args(), "SELECT pietanza.nome, pietanza.costo, pietanza.idPietanza
                                          FROM pietanza
                                          WHERE pietanza.forn_user = ?
                                          AND pietanza.idCategoria = ?");
    $data = array();
    while ($row = $result->fetch_assoc())
     $data[] = $row;
    return $data;
  }

  function getDishIngredients($dishId) {
    $result = getResult(func_get_args(), "SELECT ingrediente.nome
                                          FROM ingrediente, composizione
                                          WHERE ingrediente.idIngrediente = composizione.idIngrediente
                                          AND composizione.idPietanza = ?");
    $data = array();
    while ($row = $result->fetch_assoc())
     $data[] = $row;
    return $data;
  }

  function getDishIngredientsNames($dishId) {
    $result = getDishIngredients($dishId);
    $data = array();
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

  function deleteIngredient($ingredientId) {
    getResult(func_get_args(), "DELETE FROM ingrediente WHERE idIngrediente = ?");
  }

  function deleteCategory($categoryId) {
    getResult(func_get_args(), "DELETE FROM categoria WHERE idCategoria = ?");
  }

  function deletePlace($placeId) {
    getResult(func_get_args(), "DELETE FROM aula WHERE idAula = ?");
  }

  function insertDish($name, $price, $category, $username) {
    return getResult(func_get_args(), "INSERT INTO pietanza(nome, costo, idCategoria, forn_user) VALUES (?, ?, ?, ?)");
  }

  function insertIngredient($name) {
    return getResult(func_get_args(), "INSERT INTO ingrediente(nome) VALUES (?)");
  }

  function insertCategory($name) {
    return getResult(func_get_args(), "INSERT INTO categoria(nome) VALUES (?)");
  }

  function insertPlace($name) {
    return getResult(func_get_args(), "INSERT INTO aula(nome) VALUES (?)");
  }

  function updateRestaurantState($state, $restId) {
    getResult(func_get_args(), "UPDATE fornitore SET abilitato = ? WHERE username = ?");
  }

  function updateDish($name, $price, $category, $dishId) {
    getResult(func_get_args(), "UPDATE pietanza SET nome = ?, costo = ?, idCategoria = ?  WHERE idPietanza = ?");
  }

  function updateIngredient($name, $ingredientId) {
    getResult(func_get_args(), "UPDATE ingrediente SET nome = ? WHERE idIngrediente = ?");
  }

  function updateCategory($name, $categoryId) {
    getResult(func_get_args(), "UPDATE categoria SET nome = ? WHERE idCategoria = ?");
  }

  function updatePlace($name, $placeId) {
    getResult(func_get_args(), "UPDATE aula SET nome = ? WHERE idAula = ?");
  }

  function bindIngredientWithDish($ingredientId, $dishId) {
    getResult(func_get_args(), "INSERT INTO composizione(idIngrediente, idPietanza) VALUES (?, ?)");
  }

  function bindDishWithOrder($dishId, $orderId, $quality) {
    getResult(func_get_args(), "INSERT INTO pietanza_in_ordine(idPietanza, idOrdine, quantita) VALUES (?, ?, ?)");
  }

  function deleteBind($dishId) {
    getResult(func_get_args(), "DELETE c FROM composizione c WHERE c.idPietanza = ?");
  }

  function getPendentVendorOrders($username) {
    $result = getResult(func_get_args(), "SELECT CONCAT(cliente.nome, ' ', cliente.cognome) AS nominativo,
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
    $data = array();
    while ($row = $result->fetch_assoc())
      $data[] = $row;
    return $data;
  }

  function getActiveVendorOrders($username) {
    $result = getResult(func_get_args(), "SELECT CONCAT(cliente.nome, ' ', cliente.cognome) AS nominativo,
                                                 ordine.idOrdine AS ordine,
                                                 ordine.costoTot AS costo,
                                                 ordine.dataora AS oraConsegna,
                                                 aula.nome AS aula
                                          FROM ordine, cliente, aula
                                          WHERE ordine.cli_user = cliente.username
                                          AND ordine.idAula = aula.idAula
                                          AND ordine.idStato = 2
                                          AND ordine.forn_user = ?
                                          ORDER BY ordine.dataora ASC");
    $data = array();
    while ($row = $result->fetch_assoc())
      $data[] = $row;
    return $data;
  }

  function getClientOrders($username) {
    $result = getResult(func_get_args(), "SELECT fornitore.username AS fornitore,
                                                 fornitore.ristorante AS nominativo,
                                                 ordine.idOrdine AS ordine,
                                                 ordine.costoTot AS costo,
                                                 ordine.dataora AS oraConsegna,
                                                 aula.nome AS aula,
                                                 stato.nome AS stato,
                                                 stato.idStato AS idStato
                                          FROM ordine, fornitore, aula, stato
                                          WHERE ordine.forn_user = fornitore.username
                                          AND ordine.idAula = aula.idAula
                                          AND ordine.idStato = stato.idStato
                                          AND (ordine.idStato <> 3 OR ordine.dataora >= UNIX_TIMESTAMP(NOW()))
                                          AND ordine.dataora >= UNIX_TIMESTAMP(NOW() - INTERVAL 1 MONTH)
                                          AND ordine.cli_user = ?
                                          ORDER BY ordine.dataora DESC");
    $data = array();
    while ($row = $result->fetch_assoc())
      $data[] = $row;
    return $data;
  }

  function getDishesInOrder($orderId) {
    $result = getResult(func_get_args(), "SELECT CONCAT(pietanza.nome, ' (x', pietanza_in_ordine.quantita, ')') AS pietanza
                                          FROM pietanza_in_ordine, pietanza
                                          WHERE pietanza_in_ordine.idPietanza = pietanza.idPietanza
                                          AND idOrdine = ?");
    $data = array();
    while($row = $result->fetch_assoc())
      $data[] = $row["pietanza"];
    return $data;
  }

  function changeOrderState($newState, $orderId) {
    getResult(func_get_args(), "UPDATE ordine SET idStato = ? WHERE idOrdine = ?");
  }

  function getReviewFromOrder($orderId) {
    $result = getResult(func_get_args(), "SELECT rec_qualita, rec_prezzo FROM ordine WHERE idOrdine = ?");
    return $result->fetch_assoc();
  }

  function setOrderReview($quality, $price, $orderId) {
    getResult(func_get_args(), "UPDATE ordine SET rec_qualita = ?, rec_prezzo = ? WHERE ordine.idOrdine = ?");
    $v = getVendorFromOrder($orderId);
    getResult(array($v["qual_sum"] + $quality, $v["qual_tot"] + 1, $v["prez_sum"] + $price, $v["prez_tot"] + 1, $v["username"]),
              "UPDATE fornitore SET qual_sum = ?, qual_tot = ?, prez_sum = ?, prez_tot = ? WHERE username = ?");
  }
?>
