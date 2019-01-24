<?php
  foreach (glob('utils/*.php') as $f) require_once $f;

  switch ($_POST["req"]) {
    case "places":
      $output["places"] = getAllRooms();
      checkError(count($output["places"]) == 0, "SERVER", "QUERY", "Nessun aula visualizzare");
      break;
    case "sendOrder":
      $orderId = insertOrder($_POST["orderDetails"]["date"], $_POST["orderDetails"]["totalPrice"],
                             $_POST["orderDetails"]["place"], $_SESSION["username"], $_SESSION["chosenRest"]);
      foreach ($_POST["orderDetails"]["dishes"] as $key => $value)
        bindDishWithOrder($key, $orderId, $value["quantity"]);
      break;
  }

  closeWithoutErrors($output);
?>
