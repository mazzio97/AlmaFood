<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  switch ($_POST["request"]) {
    case "orders":
      $output["orders"] = getClientOrders($_SESSION["username"]);
      checkError(count($output["orders"]) == 0, "SERVER", "QUERY", "Nessun ordine da visualizzare");
      break;

    case "dishes_in_order":
      $output["dishes"] = getDishesInOrder($_POST["orderId"]);
      checkError(count($output["dishes"]) == 0, "SERVER", "QUERY", "Nessun piatto");
      break;

    case "getReview":
      $output["review"] = getReviewFromOrder($_POST["orderId"]);
      break;

    case "setReview":
      setOrderReview($_POST["quality"], $_POST["price"], $_POST["orderId"]);
      break;
  }
  closeWithoutErrors($output);
?>
