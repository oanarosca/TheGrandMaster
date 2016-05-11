<?php
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $password = filter_input(INPUT_POST, "retype");
  $query = "INSERT INTO utilizatori (username, parola) " .
           "VALUES ('$username', '$password')";
  mysqli_query($conn, $query);
?>
