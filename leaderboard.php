<?php
  session_start();
  require_once("php/pages.php");
  if (isset ($_SESSION['ok']))
    leaderboard();
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
