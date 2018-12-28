<?php
  session_start();
  session_destroy();
  foreach ($_COOKIE as $key => $value)
    setcookie($key, "", 1, "/");
  header("location: /almafood/");
?>
