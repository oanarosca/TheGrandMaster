<?php
  // incrementeaza numarul de incercari pentru un anumit nivel
  require_once("connect.php");
  $conn = conectare();
  session_start();
  if (isset($_SESSION['ok']) && $_GET['stage'] != 3) {
    $activitate = "activitate";
    $id = $_GET['level'];
    $stage = $_GET['stage'];
    if ($stage == '2')
      $activitate = $activitate . '2';
    $iduser = $_SESSION['ok'];
    $query = "SELECT attempts FROM ".$activitate." WHERE id_user = '$iduser' AND level = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $attempts = $row['0'];
    $attempts++;
    $query = "UPDATE ".$activitate." SET attempts = '$attempts' WHERE id_user = '$iduser' AND level = '$id'";
    mysqli_query($conn, $query);
  }
  else if ($_GET['stage'] != 3) {
    session_start();
    session_unset();
    session_destroy();
  }
?>
