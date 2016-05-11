<?php
  session_start();
  require_once("pages.php");
  $id = $_GET['id'];
  if (isset ($_SESSION['ok']))
    level($id);
  else
    error();
?>
