<?php
  $username = filter_input(INPUT_POST, 'val');
  require_once("connect.php");
  $conn = conectare();
  $query = "SELECT * ".
          "FROM utilizatori ".
          "WHERE username = '$username'";
  if (mysqli_num_rows (mysqli_query ($conn, $query)))
    echo 0;
  else
    echo 1;
?>
