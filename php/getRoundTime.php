<?php
  $runda = $_GET['round'];
  require_once("connect.php"); $conn = conectare();
  $query = "SELECT data FROM runde WHERE id_runda = '$runda'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_row($result);
  echo $row['0'];
?>
