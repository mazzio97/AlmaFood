<?php
function checkError($condition, $errorClass, $errorSource, $errorDescription) {
  if ($condition) {
    $output["error"] = array(
      "class" => $errorClass,
      "source" => $errorSource,
      "description" => $errorDescription
    );
    print json_encode($output);
    die();
  }
}

function closeWithoutErrors($output) {
  $output["error"] = array("class" => "NONE");
  print json_encode($output);
}
?>
