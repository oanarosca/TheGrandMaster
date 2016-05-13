<?php
  session_start();
  require_once("connect.php");
  $conn = conectare();
  $id = $_SESSION['ok'];
  $query = "SELECT * FROM utilizatori WHERE id_user = '$id'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result))
    $id = $row['id_user'];
  $query = "SELECT * FROM activitate WHERE id_user = '$id'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result))
    $level = $row['level'];
  echo $level;
?>
