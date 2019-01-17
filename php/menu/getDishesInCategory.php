<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $output["dish"] = getMenuDishes($_SESSION["username"], $_POST["category"]);
  checkError(count($output["dish"]) == 0, "SERVER", "QUERY", "Nessun piatto nella categoria");

  closeWithoutErrors($output);
?>
