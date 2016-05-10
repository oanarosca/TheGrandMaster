<?php
  require_once("connect.php");
  $conn = conectare();
  $name = filter_input(INPUT_POST, "username");
  $query = "INSERT INTO utilizatori (username) " .
           "VALUES ('$name')";
  mysqli_query($conn, $query);
?>
