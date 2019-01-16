<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $output["categories"] = getAllCategories();
  $output["ingredients"] = getAllIngredients();
  
  closeWithoutErrors($output);
?>
