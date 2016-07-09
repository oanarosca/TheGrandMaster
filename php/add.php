<?php
  // introduce datele unui nou utilizator in baza de date, seteaza in tabelul de
  // activitate nivelul pe 1 si seteaza variabila de sesiune a utilizatorului
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $password = filter_input(INPUT_POST, "retype");
  $pcr = md5($password);
  $query = "INSERT INTO utilizatori (username, parola) " .
           "VALUES ('$username', '$pcr')";
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
