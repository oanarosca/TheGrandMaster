<?php
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $parola = filter_input(INPUT_POST, "password");
  $pcr = md5($parola);
  $query = "SELECT * ".
           "FROM utilizatori ".
           "WHERE username = '$username' AND parola = '$pcr'";
  $result = mysqli_query ($conn, $query);
  if (mysqli_num_rows ($result)) {
    echo 1;
    session_start();
    while ($row = mysqli_fetch_array($result))
      $id = $row['id_user'];
    $_SESSION['ok'] = $id;
  }
  else
    echo 0;
?>
