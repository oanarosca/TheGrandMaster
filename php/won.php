<?php
  session_start();
  require_once("connect.php");
  $conn = conectare();
  if (isset ($_SESSION['ok'])) {
    $level = $_GET['level'];
    $points = $_GET['points'];
    $id = $_SESSION['ok'];
    $time = $_GET['time'];
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
    $query = "SELECT points FROM activitate WHERE id_user='$id' AND level = '$level'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
      $oldpoints = $row['0'];
    if ($points > $oldpoints) {
      $query = "UPDATE activitate SET points = '$points' WHERE id_user = '$id' AND level = '$level'";
      mysqli_query($conn, $query);
    }
    $query = "SELECT time FROM activitate WHERE id_user = '$id' AND level = '$level'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
      $oldtime = $row['0'];
    if ($time < $oldtime || $oldtime == 0) {
      $query = "UPDATE activitate SET time = '$time' WHERE id_user = '$id' AND level = '$level'";
      mysqli_query($conn, $query);
    }
    if ($max == $level /*&& $level != 18*/) { // deblocam noul nivel
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
