<?php
  session_start();
  require_once("php/pages.php");
  if (isset ($_SESSION['ok'])) {
    $id = $_GET['id'];
    profile($id);
  }
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
