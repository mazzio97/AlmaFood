<?php
  session_start();

  $req = isset($_POST["req"]) ? $_POST["req"] : "";
  $var = isset($_POST["var"]) ? $_POST["var"] : "";
  $val = isset($_POST["val"]) ? $_POST["val"] : "";

  switch ($req) {
    case "get":
      if ($var == "all")
        print json_encode($_SESSION);
      else
        print json_encode(isset($_SESSION[$var]) ? $_SESSION[$var] : $var . " is not present");
      break;

    case "set":
      $_SESSION[$var] = $val;
      break;

    case "del":
      unset($_SESSION[$var]);
      break;

    default:
      print json_encode("request not set");
  }
?>
