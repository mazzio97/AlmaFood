<?php
  foreach (glob('utils/*.php') as $f) require_once $f;

  $output = array();
  switch ($_POST["request"]) {
    case "get":
      $output["categories"] = getAllCategories();
      $output["ingredients"] = getAllIngredients();
      if (isset($_SESSION["currentDish"])) {
        $output["dishInfo"] = getDishInfo($_SESSION["currentDish"]);
        $output["dishIngredients"] = getDishIngredientsNames($_SESSION["currentDish"]);
      }
      break;

    case "save":
      if (isset($_SESSION["currentDish"])) {
        updateDish($_POST["name"], $_POST["price"], $_POST["category"],  $_SESSION["currentDish"]);
        deleteBind($_SESSION["currentDish"]);
      } else {
        $_SESSION["currentDish"] = insertDish($_POST["name"], $_POST["price"], $_POST["category"], $_SESSION["username"]);
      }
      if (isset($_POST["ingredients"])) {
        foreach($_POST["ingredients"] as $ingredientID)
          bindIngredientWithDish($ingredientID, $_SESSION["currentDish"]);
      unset($_SESSION["currentDish"]);
      }
      break;
  }
  closeWithoutErrors($output);
?>
