<?php
  require_once("connect.php");
  $conn = conectare();
  $date = filter_input(INPUT_POST, "date");
  $time = filter_input(INPUT_POST, "time");
  $str = $date . "T" . $time;
  $query = "INSERT INTO runde (data) VALUES ('$str')";
  mysqli_query($conn, $query);
  $query = "SELECT LAST_INSERT_ID()";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_row($result);
  $id_runda = $row[0];
  for ($j = 0; $j < 5; $j++) {
    $level = $_GET['l'.$j];
    $var = mt_rand(1, 4);
    $query = "SELECT * FROM combinatii WHERE nivel = '$level' ORDER BY id_comb";
    $result = mysqli_query($conn, $query);
    for ($i = 1; $i <= $var; $i++)
      $row = mysqli_fetch_array($result);
    $id_comb = $row['id_comb'];
    $index = $j+1;
    $query = "INSERT INTO combRunda (id_runda, id_comb, ind) VALUES ('$id_runda', '$id_comb', '$index')";
    mysqli_query($conn, $query);
  }
?>
