<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $username = isset($_SESSION["choosenRest"]) ? getVendorUserFromName($_SESSION["choosenRest"]) : $_SESSION["username"];
  $output["dish"] = getMenuDishes($username, $_POST["category"]);
  checkError(count($output["dish"]) == 0, "SERVER", "QUERY", "Nessun piatto nella categoria");

  closeWithoutErrors($output);
?>
