<?php
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, 'val');
  $query = "SELECT * ".
          "FROM utilizatori ".
          "WHERE username = '$username'";
  if (mysqli_num_rows (mysqli_query ($conn, $query))) {
    echo 1;
    session_start();
    $_SESSION['ok'] = $username;
  }
  else
    echo 0;
?>
