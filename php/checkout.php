<?php
  foreach (glob('utils/*.php') as $f) require_once $f;

  switch ($_POST["req"]) {
    case "places":
      $output["places"] = getAllRooms();
      checkError(count($output["places"]) == 0, "SERVER", "QUERY", "Nessun aula visualizzare");
      break;
    case "sendOrder":
      $vendor_user = getVendorUserFromName($_SESSION["choosenRest"]);
      $placeId = getPlaceIdFromName($_POST["orderDetails"]["placeName"]);
      $orderId = insertOrder($_POST["orderDetails"]["date"], $_POST["orderDetails"]["totalPrice"],
                             $placeId, $_SESSION["username"], $vendor_user);
      foreach ($_POST["orderDetails"]["dishes"] as $key => $value)
        bindDishWithOrder(getDishIdByName($key, $vendor_user), $orderId, $value["quantity"]);
      break;
  }

  closeWithoutErrors($output);
?>
