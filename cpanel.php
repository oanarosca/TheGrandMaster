<?php
  require_once("php/pages.php");
  session_start();
  if (isset($_SESSION['sudo']))
    cpanel();
  else
    error();
?>
