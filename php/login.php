<?php
$output = array();

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

// SESSION
session_start();

// CONNECTION
$connection = new mysqli("localhost", "root", "", "almafood");
checkError($connection->connect_error, "SERVER", "CONNECTION", $connection->connect_error);

// QUERY
foreach (array("cliente", "fornitore") as $table) {
  $statement = $connection->prepare("SELECT * FROM " . $table . " WHERE email = ? OR username = ?");
  $statement->bind_param("ss", $_POST["user"], $_POST["user"]);
  $statement->execute();
  $result = $statement->get_result();
  checkError($result === false, "SERVER", "QUERY", $connection->error);
  if ($data = $result->fetch_assoc())
    break;
}
$statement->close();
$connection->close();

// DATA
checkError($data === NULL, "USER", "USERNAME", $_POST["user"] . " non è uno username/e-mail presente");
checkError($data["password"] != $_POST["password"], "USER", "PASSWORD", "password errata");
unset($data["password"]);

// SESSION AND COOKIES
$_SESSION["tipo"] = isset($data["ristorante"]) ? "fornitore" : "cliente";
$expires = $_POST["remember"] == "true" ? 2147483647 : 1;
foreach ($data as $key => $value) {
  $_SESSION[$key] = $value;
  setcookie($key, $value, $expires, "/");
}

$output["error"] = array("class" => "NONE");
print json_encode($output);
?>
