<?php
  session_start();
  require_once("connect.php");
  $conn = conectare();
  if (isset ($_SESSION['ok'])) {
    // cand utilizatorul castiga un nivel, in baza de date se actualizeaza, daca este cazul,
    // punctajul maxim si timpul in care s-a rezolvat un nivel. Se creste numarul de castiguri
    // ale nivelului respectiv si se deblocheaza unul nou, daca mai exista.
    $level = $_GET['level'];
    $points = $_GET['points'];
    $id = $_SESSION['ok'];
    $time = $_GET['time'];
    $stage = $_GET['stage'];
    $runda = $_GET['runda'];
    if ($stage == 1 || $stage == 2) {
      $activitate = "activitate" . $runda;
      $query = "SELECT total FROM ".$activitate." WHERE id_user = '$id' AND level = '$level'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      $total = $row['0'];
      $total += $points;
      $query = "UPDATE ".$activitate." SET total = '$total' WHERE id_user = '$id' AND level = '$level'";
      mysqli_query($conn, $query);
      $query = "SELECT MAX(level) FROM ".$activitate." WHERE id_user = '$id'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result))
        $max = $row['0'];
      $query = "SELECT wins FROM ".$activitate." WHERE id_user = '$id' AND level = '$level'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result))
        $wins = $row['0'];
      $wins++;
      $query = "UPDATE ".$activitate." SET wins = '$wins' WHERE id_user = '$id' AND level = '$level'";
      mysqli_query($conn, $query);
      $query = "SELECT points FROM ".$activitate." WHERE id_user='$id' AND level = '$level'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result))
        $oldpoints = $row['0'];
      if ($points > $oldpoints) {
        $query = "UPDATE ".$activitate." SET points = '$points' WHERE id_user = '$id' AND level = '$level'";
        mysqli_query($conn, $query);
      }
      $query = "SELECT time FROM ".$activitate." WHERE id_user = '$id' AND level = '$level'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result))
        $oldtime = $row['0'];
      if ($time < $oldtime || $oldtime == 0) {
        $query = "UPDATE ".$activitate." SET time = '$time' WHERE id_user = '$id' AND level = '$level'";
        mysqli_query($conn, $query);
      }
      if ($max == $level) { // deblocam noul nivel
        $level++;
        $query = "INSERT INTO ".$activitate." (id_user, level) VALUES ('$id', '$level')";
        mysqli_query($conn, $query);
      }
    }
    else {
      $query = "SELECT id_comb FROM activitate3 WHERE id_runda = '$runda' AND ind = '$level'";
      $result = mysqli_query($conn, $query); $row = mysqli_fetch_row($result);
      $id_comb = $row['0'];
      $query = "SELECT timp FROM activitate3 WHERE id_user = '$id' AND id_comb = '$id_comb' AND id_runda = '$runda'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_row($result); $oldtime = $row['0'];
      if ($time < $oldtime || $oldtime == 0) {
        $query = "UPDATE activitate3 SET timp = '$time' WHERE id_user = '$id' AND id_comb = '$id_comb' AND id_runda = '$runda'";
        mysqli_query($conn, $query);
      }
      $query = "SELECT MAX(id_comb) FROM activitate3 WHERE id_user = '$id' AND id_runda = '$runda'";
      $result = mysqli_query($conn, $query); $row = mysqli_fetch_row($result);
      $max = $row['0'];
      if ($max == $id_comb) {
        $level++;
        $query = "SELECT id_comb FROM combRunda WHERE id_runda = '$runda' AND ind = '$level'";
        $result = mysqli_query($conn, $query); $row = mysqli_fetch_row($result);
        $id_comb = $row['0'];
        $query = "INSERT INTO activitate3 (id_runda, id_user, id_comb, ind) ".
                 "VALUES ('$runda', '$id', '$id_comb', '$level')";
        mysqli_query($conn, $query);
      }
    }
  }
  else
    error();
?>
