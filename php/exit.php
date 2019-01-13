<?php
  require_once "utils/session.php";

  session_destroy();
  foreach ($_COOKIE as $key => $value)
    setcookie($key, "", 1, "/");
  header("location: /almafood/");
?>
