<?php
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $password = filter_input(INPUT_POST, "retype");
  $query = "INSERT INTO utilizatori (username, parola) " .
           "VALUES ('$username', '$password')";
  mysqli_query($conn, $query);
  echo 1;
  $query = "SELECT * FROM utilizatori WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result))
    $id = $row['id_user'];
  $query = "INSERT INTO activitate (id_user, level) VALUES ('$id', '1')";
  mysqli_query($conn, $query);
  session_start();
  $query = "SELECT * FROM utilizatori WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result))
    $id = $row['id_user'];
  $_SESSION['ok'] = $id;
?>
