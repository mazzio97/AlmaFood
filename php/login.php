<?php
foreach (glob('utils/*.php') as $f) require_once $f;

// CHECK
$data = getUserData($_POST["user"], $_POST["user"]);
checkError($data === NULL, "USER", "USERNAME", "questo username/e-mail non è presente");
checkError(!password_verify($_POST["password"], $data["password"]), "USER", "PASSWORD", "password errata");
unset($data["password"]);

// SESSION AND COOKIES
if (isset($data["ristorante"])) {
  $data["tipo"] = "fornitore";
  $data["nominativo"] = $data["ristorante"];
} else {
  $data["tipo"] = "cliente";
  $data["nominativo"] = $data["nome"] . " " . $data["cognome"];
}
$expires = $_POST["remember"] == "true" ? 2147483647 : 1;
foreach ($data as $key => $value) {
  $_SESSION[$key] = $value;
  setcookie($key, $value, $expires, "/");
}

closeWithoutErrors(array());
?>
