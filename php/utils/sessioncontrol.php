<?php
  require_once "session.php";
  
  if(!isset($_SESSION["username"]))
    header("location: /almafood/");
?>
