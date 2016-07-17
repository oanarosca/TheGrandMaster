<?php
  require_once("connect.php");
  $conn = conectare();
  $level = $_GET['id'];
  $query = "SELECT * FROM niveluri WHERE nivel = '$level'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result)) {
    $bilute = $row['bilute'];
    $incercari =  $row['incercari'];
    $locuri = $row['locuri'];
  }
  echo $bilute . $locuri . $incercari;
?>
