<?php
  require_once("connect.php");
  $conn = conectare();
  $level = $_GET['id'];
  $stage = $_GET['stage'];
  if ($stage == 3) {
    session_start(); $id_comb = $_SESSION['level'];
    $query = "SELECT nivel FROM combinatii WHERE id_comb = '$id_comb'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $level = $row['0'];
  }
  $query = "SELECT * FROM niveluri WHERE nivel = '$level'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $bilute = $row['bilute'];
  $incercari =  $row['incercari'];
  $locuri = $row['locuri'];
  echo $bilute . $locuri . $incercari;
?>
