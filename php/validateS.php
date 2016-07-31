<?php
  // valideaza datele de intrare pentru superuser
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $parola = filter_input(INPUT_POST, "password");
  $pcr = md5($parola);
  $stmt = $conn->prepare("SELECT * FROM utilizatori WHERE username = ? AND parola = '$pcr'");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  if (mysqli_num_rows($result)) {
    session_start();
    echo 1;
    $_SESSION['sudo'] = 0;
  }
  else
    echo 0;
?>
