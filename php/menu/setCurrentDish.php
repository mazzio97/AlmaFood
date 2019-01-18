<?php
foreach (glob('../utils/*.php') as $f) require_once $f;
$_SESSION["currentDish"] = $_POST["dishId"];
?>
