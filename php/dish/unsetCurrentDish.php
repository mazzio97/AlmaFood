<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;
  if (isset($_SESSION["currentDish"]))
    unset($_SESSION["currentDish"]);
?>
