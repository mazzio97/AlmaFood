<?php
  foreach (glob('utils/*.php') as $f) require_once $f;
  $output = array();
  switch ($_POST["request"]) {
    case "getData":
      $output["ingredients"] = getAllIngredients();
      checkError(count($output["ingredients"]) == 0, "SERVER", "QUERY", "Nessun ingrediente da visualizzare");
      $output["categories"] = getAllCategories();
      checkError(count($output["categories"]) == 0, "SERVER", "QUERY", "Nessuna categoria da visualizzare");
      $output["places"] = getAllPlaces();
      checkError(count($output["places"]) == 0, "SERVER", "QUERY", "Nessun aula da visualizzare");
      $output["vendors"] = getAllVendors();
      checkError(count($output["vendors"]) == 0, "SERVER", "QUERY", "Nessun fornitore da visualizzare");
      break;
    case "ingredientsUpdate":
      if (isset($_POST["value"]))
        updateIngredient($_POST["value"], $_POST["id"]);
      else
        deleteIngredient($_POST["id"]);
      break;
    case "categoriesUpdate":
      if (isset($_POST["value"]))
        updateCategory($_POST["value"], $_POST["id"]);
      else
        deleteCategory($_POST["id"]);
      break;
    case "placesUpdate":
      if (isset($_POST["value"]))
        updatePlace($_POST["value"], $_POST["id"]);
      else
        deletePlace($_POST["id"]);
      break;
    case "stateUpdate":
        updateRestaurantState($_POST["state"], $_POST["id"]);
      break;
      case "ingredientsInsertion":
        $output["id"] = insertIngredient($_POST["name"]);
        break;
      case "categoriesInsertion":
        $output["id"] = insertCategory($_POST["name"]);
        break;
      case "placesInsertion":
        $output["id"] = insertPlace($_POST["name"]);
        break;
  }
  closeWithoutErrors($output);

?>
