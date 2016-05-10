<?php
  require_once("connect.php");
  $conn = conectare();
  $email = filter_input(INPUT_POST, "email");
  $query = "INSERT INTO utilizatori (email) " .
           "VALUES ('$email')";
  mysqli_query($conn, $query);
?>
