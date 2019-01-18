<?php
  foreach (glob('../utils/*.php') as $f) require_once $f;
  deleteDish($_POST["dishId"]);
?>
