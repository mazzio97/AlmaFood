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
  $statement->bind_param("ss", $_POST["email"], $_POST["username"]);
  $statement->execute();
  $result = $statement->get_result();
  checkError($result === false, "SERVER", "QUERY", $connection->error);
  if ($data = $result->fetch_assoc())
    break;
}
checkError($data and $data["username"] === $_POST["username"], "USER", "USERNAME", "questo username è già presente");
checkError($data and $data["email"] === $_POST["email"], "USER", "EMAIL", "questa e-mail è già stata utilizzata");

// INSERTION
if ($_POST["userRole"] === "cliente") {
  $statement = $connection->prepare("INSERT INTO cliente(email, username, password, nome, cognome) VALUES (?, ?, ?, ?, ?)");
  $statement->bind_param("sssss", $_POST["email"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"]);
} else {
  $statement = $connection->prepare("INSERT INTO fornitore(email, username, password, nome, cognome, ristorante) VALUES (?, ?, ?, ?, ?, ?)");
  $statement->bind_param("ssssss", $_POST["email"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["restaurant"]);
}
checkError($statement->execute() === false, "SERVER", "QUERY", $connection->error);
$statement->close();
$connection->close();

// SESSION
$_SESSION["username"] = $_POST["username"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["nome"] = $_POST["name"];
$_SESSION["cognome"] = $_POST["surname"];
$_SESSION["ruolo"] = $_POST["userRole"];
if ($_POST["userRole"] == "fornitore")
  $_SESSION["ristorante"] = $_POST["restaurant"];

$output["error"] = array("class" => "NONE");
print json_encode($output);
?>
