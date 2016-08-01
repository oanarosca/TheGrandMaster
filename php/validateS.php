<?php
  // valideaza datele de intrare pentru superuser
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $parola = filter_input(INPUT_POST, "password");
  $stmt = $conn->prepare("SELECT parola FROM utilizatori " .
          "WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_row($result); $pcr = $row['0'];
    if (password_verify($parola, $pcr)) {
      session_start();
      echo 1;
      $_SESSION['sudo'] = 0;
    }
    else echo 0;
  }
  else
    echo 0;
?>
