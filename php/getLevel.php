<?php
  function getLevel () {
    require_once("connect.php");
    $conn = conectare();
    $id = $_SESSION['ok'];
    $query = "SELECT MAX(level) FROM activitate WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
      $level = $row['0'];
    return $level;
  }
?>
