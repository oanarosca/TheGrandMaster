<?php
  // ia nivelul la care a ajuns utilizatorul
  function getLevel ($stage) {
    require_once("connect.php");
    $conn = conectare();
    $id = $_SESSION['ok'];
    $activitate = "activitate".$stage;
    $query = "SELECT MAX(level) FROM `$activitate` WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $level = $row['0'];
    return $level;
  }
?>
