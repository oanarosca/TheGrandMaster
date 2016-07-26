<?php
  require_once("php/pages.php");
  session_start();
  if (isset($_SESSION['sudo'])) {
    cpanel();
  }
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
