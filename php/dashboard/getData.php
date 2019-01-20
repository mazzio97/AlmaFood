<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  switch ($_POST["request"]) {
    case "orders":
      $output["order"] = getPendentVendorOrders($_SESSION["username"]);
      checkError(count($output["order"]) == 0, "SERVER", "QUERY", "Nessun ordine da visualizzare");
      break;

    case "dishes_in_order":
      $output["dish"] = getDishesInOrder($_POST["orderId"]);
      checkError(count($output["dish"]) == 0, "SERVER", "QUERY", "Nessun risultato");
      break;

    case "modify_order":
      changeOrderState($_POST["state"], $_POST["orderId"]);
      $output = array();
      break;
	}

  closeWithoutErrors($output);
?>
