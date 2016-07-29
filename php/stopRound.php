<?php
  require_once("connect.php"); $conn = conectare();
  $runda = $_GET['round'];
  echo $runda;
  $query = "UPDATE runde SET terminata = 2 WHERE id_runda = '$runda'";
  mysqli_query($conn, $query);
?>
