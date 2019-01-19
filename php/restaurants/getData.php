<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;

  $output["restaurants"] = getAllVendors();
  checkError(count($output["restaurants"]) == 0, "SERVER", "QUERY", "Nessun ristorante");
  foreach ($output["restaurants"] as $username => $data)
    $output["restaurants"][$username]["categories"] = getCategoriesFromVendor($username);

  $output["categories"] = array();
  $rawData = getAllCategories();
  foreach ($rawData as $name => $id)
    $output["categories"][] = $name;

  closeWithoutErrors($output);
?>
