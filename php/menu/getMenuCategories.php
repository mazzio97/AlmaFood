<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;
  
  $username = isset($_SESSION["choosenRest"]) ? getVendorUserFromName($_SESSION["choosenRest"]) : $_SESSION["username"];
  $output["category"] = getMenuCategories($username);
  checkError(count($output["category"]) == 0, "SERVER", "QUERY", "Nessuna categoria da visualizzare");

  closeWithoutErrors($output);
?>
