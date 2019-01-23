<?php
foreach (glob('utils/*.php') as $f) require_once $f;

// CHECK
$data = getUserData($_POST["email"], $_POST["username"]);
checkError($data and $data["username"] === $_POST["username"], "USER", "USERNAME", "questo username è già presente");
checkError($data and $data["email"] === $_POST["email"], "USER", "EMAIL", "questa e-mail è già stata utilizzata");

// INSERTION
if ($_POST["userRole"] === "cliente")
  insertClient($_POST["email"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"]);
else
  insertVendor($_POST["email"], $_POST["username"], $_POST["password"], $_POST["restaurant"]);

// SESSION
$_SESSION["username"] = $_POST["username"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["tipo"] = $_POST["userRole"];
if ($_POST["userRole"] == "fornitore") {
  $_SESSION["ristorante"] = $_POST["restaurant"];
  $_SESSION["nominativo"] = $_POST["restaurant"];
}
else {
  $_SESSION["nome"] = $_POST["name"];
  $_SESSION["cognome"] = $_POST["surname"];
  $_SESSION["nominativo"] = $_POST["name"] . " " . $_POST["surname"];
}

closeWithoutErrors(array());
?>
