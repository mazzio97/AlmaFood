<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $output["category"] = getMenuCategories($_SESSION["username"]);
  checkError(count($output["category"]) == 0, "SERVER", "QUERY", "Nessuna categoria da visualizzare");

  closeWithoutErrors($output);
?>
