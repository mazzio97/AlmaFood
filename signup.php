<?php
function checkError($condition, $errid, $error) {
  if ($condition) {
    $_SESSION["errid"] = $errid;
    $_SESSION["error"] = $error;
    header("location: /almafood");
  }
}

// SESSION
session_start();
checkError(!isset($_POST["name"]) or !isset($_POST["surname"]) or !isset($_POST["email"]) or !isset($_POST["username"]) or
           !isset($_POST["userRole"]) or !isset($_POST["restaurant"]) or !isset($_POST["password"]), "INTERNAL", "missing variables");

// CONNECTION
$connection = new mysqli("localhost", "root", "", "almafood");
checkError($connection->connect_error, "SERVER", "connection failed:" . $connection->connect_error);

// QUERY
foreach (array("cliente", "fornitore") as $table) {
  $statement = $connection->prepare("SELECT * FROM " . $table . " WHERE email = ? OR username = ?");
  $statement->bind_param("ss", $_POST["email"], $_POST["username"]);
  $statement->execute();
  $result = $statement->get_result();
  checkError($result === false, "SERVER", "query failed: " .  $connection->error);
  if ($data = $result->fetch_assoc())
    break;
}
checkError($data and $data["username"] === $_POST["username"], "USER", "this username already signed up");
checkError($data and $data["email"] === $_POST["email"], "USER", "this email already signed up");

// INSERTION
if ($_POST["userRole"] === "client") {
  $statement = $connection->prepare("INSERT INTO cliente(email, username, password, nome, cognome) VALUES (?, ?, ?, ?, ?)");
  $statement->bind_param("sssss", $_POST["email"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"]);
} else {
  $statement = $connection->prepare("INSERT INTO fornitore(email, username, password, nome, cognome, ristorante) VALUES (?, ?, ?, ?, ?, ?)");
  $statement->bind_param("ssssss", $_POST["email"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["restaurant"]);
}
checkError($statement->execute() === false, "SERVER", "insertion failed: " . $connection->error);
$statement->close();
$connection->close();

// SESSION
$_SESSION["username"] = $_POST["username"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["nome"] = $_POST["name"];
$_SESSION["cognome"] = $_POST["surname"];
if($_POST["userRole"] === "client")
  $_SESSION["tipo"] = "cliente";
else {
  $_SESSION["tipo"] = "fornitore";
  $_SESSION["ristorante"] = $_POST["restaurant"];
}
header("location: /almafood/dashboard.php");
?>
