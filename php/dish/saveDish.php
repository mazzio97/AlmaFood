<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;
  if (isset($_SESSION["currentDish"])) {
    updateDish($_POST["name"], $_POST["price"], $_POST["category"],  $_SESSION["currentDish"]);
    if (isset($_POST["ingredients"])) {
      deleteBind($_SESSION["currentDish"]);
      foreach($_POST["ingredients"] as $ingredientID)
        bindIngredientWithDish($ingredientID, $_SESSION["currentDish"]);
    }
    unset($_SESSION["currentDish"]);
  } else {
    $dishID = insertDish($_POST["name"], $_POST["price"], $_POST["category"], $_SESSION["username"]);
    if (isset($_POST["ingredients"]))
      foreach($_POST["ingredients"] as $ingredientID)
        bindIngredientWithDish($ingredientID, $dishID);
  }

  closeWithoutErrors(array());
?>
