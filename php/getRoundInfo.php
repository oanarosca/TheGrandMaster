<?php
  session_start();
  require_once("connect.php");
  $conn = conectare();
  $id = $_SESSION['ok'];
  $runda = $_GET['runda'];
  $query = "SELECT MAX(ind) FROM activitate3 WHERE id_user = '$id' AND id_runda = '$runda'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_row($result);
  echo $row['0'];
?>
