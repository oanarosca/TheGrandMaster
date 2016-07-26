<?php
  // valideaza datele de intrare pentru superuser
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $parola = filter_input(INPUT_POST, "password");
  $pcr = md5($parola);
  $query = "SELECT * FROM utilizatori WHERE id_user = 0 AND parola = '$pcr'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result)) {
    session_start();
    echo 1;
    $_SESSION['ok'] = 0;
  }
  else
    echo 0;
?>
