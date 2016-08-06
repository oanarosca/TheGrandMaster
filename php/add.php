<?php
  // introduce datele unui nou utilizator in baza de date, seteaza in tabelul de
  // activitate nivelul pe 1 si seteaza variabila de sesiune a utilizatorului
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $password = filter_input(INPUT_POST, "retype");
  //$pcr = md5($password);
  $pcr = password_hash($password, PASSWORD_BCRYPT);
  $stmt = $conn->prepare("INSERT INTO utilizatori (username, parola) VALUES (?, '$pcr')");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->close();
  echo 1;
  $stmt = $conn->prepare("SELECT * FROM utilizatori WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  while ($row = mysqli_fetch_array($result))
    $id = $row['id_user'];
  $query = "INSERT INTO activitate1 (id_user, level) VALUES ('$id', '1')";
  mysqli_query($conn, $query);
  $query = "INSERT INTO activitate2 (id_user, level) VALUES ('$id', '1')";
  mysqli_query($conn, $query);
  session_start();
  $_SESSION['ok'] = $id;
?>
