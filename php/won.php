<?php
  session_start();
  require_once("connect.php");
  $conn = conectare();
  if (isset ($_SESSION['ok'])) {
    $level = $_GET['level'];
    $id = $_SESSION['ok'];
    $query = "SELECT MAX(level) FROM activitate WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
      $max = $row['0'];
    $query = "SELECT wins FROM activitate WHERE id_user = '$id' AND level = '$level'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
      $wins = $row['0'];
    $wins++;
    $query = "UPDATE activitate SET wins = '$wins' WHERE id_user = '$id' AND level = '$level'";
    mysqli_query($conn, $query);
    if ($max == $level && $level != 18) { // deblocam noul nivel
      $level++;
      $query = "INSERT INTO activitate (id_user, level) VALUES ('$id', '$level')";
      mysqli_query($conn, $query);
    }
  }
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
