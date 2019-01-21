<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  switch ($_POST["request"]) {
    case "orders":
      $output["orders"] = getActiveVendorOrders($_SESSION["username"]);
      checkError(count($output["orders"]) == 0, "SERVER", "QUERY", "Nessun ordine da visualizzare");
      foreach ($output["orders"] as $key => $order) {
        $output["orders"][$key]["dishes"] = getDishesInOrder($order["ordine"]);
        if (count($output["orders"][$key]["dishes"]) == 0)
          $output["orders"][$key]["dishes"][0] = "Nessun piatto";
      }
      break;

    case "send":
      changeOrderState(4, $_POST["orderId"]);
      $output = array();
      break;
  }

  closeWithoutErrors($output);
?>
