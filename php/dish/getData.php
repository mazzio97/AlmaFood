<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $output["categories"] = getAllCategories();
  $output["ingredients"] = getAllIngredients();
  if (isset($_SESSION["currentDish"])) {
    $output["dishInfo"] = getDishInfo($_SESSION["currentDish"]);
    $output["dishIngredients"] = getDishIngredientsNames($_SESSION["currentDish"]);
  }

  closeWithoutErrors($output);
?>
