<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $output["category"] = getMenuCategories($_SESSION["username"]);
  checkError(count($output["category"]) == 0, "SERVER", "QUERY", "Nessuna categoria da visualizzare");
  // switch ($_POST["request"]) {
  //   case "categories":
  //     $output["category"] = getMenuCategories($_SESSION["username"]);
  //     checkError(count($output["category"]) == 0, "SERVER", "QUERY", "Nessuna categoria da visualizzare");
  //     break;
  //
  //   case "dishes_in_menu_categories":
  //     $output["dish"] = getMenuDishes($_SESSION["username"], $_POST["categoryId"])
  //     checkError(count($output["category"]) == 0, "SERVER", "QUERY", "Nessun piatto nella categoria");
  //     break;
  //
  //   case "ingredients_in_dish":
  //     $output["category"] = getDishIngredients($_POST["dishId"]);
  //     checkError(count($output["category"]) == 0, "SERVER", "QUERY", "Nessun ingrediente da visualizzare");
  //     break;
  // }
  closeWithoutErrors($output);
?>
