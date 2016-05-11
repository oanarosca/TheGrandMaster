<?php
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $parola = filter_input(INPUT_POST, "password");
  $query = "SELECT * ".
           "FROM utilizatori ".
           "WHERE username = '$username' AND parola = '$parola'";
  if (mysqli_num_rows (mysqli_query ($conn, $query)))
    echo 1;
  else
    echo 0;
?>
