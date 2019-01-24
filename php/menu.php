<?php
  foreach (glob('utils/*.php') as $f) require_once $f;

  switch ($_POST["request"]) {
    case "categories":
      $username = isset($_SESSION["chosenRest"]) ? $_SESSION["chosenRest"] : $_SESSION["username"];
      $output["category"] = getMenuCategories($username);
      checkError(count($output["category"]) == 0, "SERVER", "QUERY", "Nessuna categoria da visualizzare");
      break;

    case "dishes":
      $username = isset($_SESSION["chosenRest"]) ? $_SESSION["chosenRest"] : $_SESSION["username"];
      $output["dish"] = getMenuDishes($username, $_POST["category"]);
      checkError(count($output["dish"]) == 0, "SERVER", "QUERY", "Nessun piatto nella categoria");
      break;

    case "ingredients":
      $output["ingredient"] = getDishIngredients($_POST["dish"]);
      checkError(count($output["ingredient"]) == 0, "SERVER", "QUERY", "Nessun ingrediente da visualizzare");
      break;

    case "delete":
      deleteDish($_POST["dish"]);
      checkError(count($output["ingredient"]) == 0, "SERVER", "QUERY", "Nessun ingrediente cancellare");
      break;
  }

  closeWithoutErrors($output);
?>
