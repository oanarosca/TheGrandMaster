<?php
  // valideaza parola la intrarea in cont
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
    session_start();
    echo 1;
    $row = mysqli_fetch_array($result);
    $id = $row['id_user'];
    $_SESSION['ok'] = $id;
    $query = "SELECT * FROM activitate2 WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);
    if (!mysqli_num_rows($result)) {
      $query = "INSERT INTO activitate2 (id_user, level) VALUES ('$id', '1')";
      mysqli_query($conn, $query);
    }
  }
  else
    echo 0;
?>
