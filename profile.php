<?php
  session_start();
  require_once("pages.php");
  if (isset ($_SESSION['ok']))
    profile();
  else
    error();
?>