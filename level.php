<?php
  session_start();
  require_once("php/pages.php");
  require_once("php/connect.php");
  $conn = conectare();
  $id = $_GET['id'];
  $query = "SELECT * FROM niveluri WHERE nivel = '$id'";
  $iduser = $_SESSION['ok'];
  if (isset ($_SESSION['ok']) && mysqli_num_rows(mysqli_query($conn, $query))) {
    $query = "SELECT MAX(level) FROM activitate WHERE id_user = '$iduser'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
      $level = $row['0'];
    if ($level < $id) {
      session_unset();
      session_destroy();
      error();
    }
    else {
      $query = "SELECT attempts FROM activitate WHERE id_user = '$iduser' AND level = '$id'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result))
        $attempts = $row['0'];
      $attempts++;
      $query = "UPDATE activitate SET attempts='$attempts' WHERE id_user = '$iduser' AND level = '$id'";
      mysqli_query($conn, $query);
      level($id);
    }
  }
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
