<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $output["ingredient"] = getDishIngredients($_POST["dish"]);
  checkError(count($output["ingredient"]) == 0, "SERVER", "QUERY", "Nessun ingrediente da visualizzare");

  closeWithoutErrors($output);
?>
