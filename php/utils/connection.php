<?php
  require_once "errors.php";

  $connection = new mysqli("localhost", "root", "", "almafood");
  checkError($connection->connect_error, "SERVER", "CONNECTION", $connection->connect_error);
?>
