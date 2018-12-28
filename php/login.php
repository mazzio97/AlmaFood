<?php
function checkError($condition, $errid, $error) {
  if ($condition) {
    $_SESSION["errid"] = $errid;
    $_SESSION["error"] = $error;
    header("location: /almafood/");
    die();
  }
}

// SESSION
session_start();
checkError(!isset($_POST["user"]) or !isset($_POST["password"]), "INTERNAL", "missing variables");

// CONNECTION
$connection = new mysqli("localhost", "root", "", "almafood");
checkError($connection->connect_error, "SERVER", "connection failed:" . $connection->connect_error);

// QUERY
foreach (array("cliente", "fornitore") as $table) {
  $statement = $connection->prepare("SELECT * FROM " . $table . " WHERE email = ? OR username = ?");
  $statement->bind_param("ss", $_POST["user"], $_POST["user"]);
  $statement->execute();
  $result = $statement->get_result();
  checkError($result === false, "SERVER", "query failed: " .  $connection->error);
  if ($data = $result->fetch_assoc())
    break;
}
$statement->close();
$connection->close();

// DATA
checkError($data === NULL, "USER", $_POST["user"] . " is not a registered user/mail");
checkError($data["password"] != $_POST["password"], "USER", "wrong password");
unset($_SESSION["errid"]);
unset($_SESSION["error"]);

// SESSION AND COOKIES
$_SESSION["tipo"] = isset($data["ristorante"]) ? "fornitore" : "cliente";

$expires = isset($_POST["remember"]) ? 2147483647 : 1;
foreach ($data as $key => $value) {
  $_SESSION[$key] = $value;
  setcookie($key, $value, $expires, "/");
}
unset($_SESSION["password"]);
setcookie("password", "", 1, "/");

header("location: /almafood/dashboard.php");
?>
