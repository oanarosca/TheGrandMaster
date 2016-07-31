<?php
  // valideaza parola la intrarea in cont
  require_once("connect.php");
  $conn = conectare();
  $username = filter_input(INPUT_POST, "username");
  $parola = filter_input(INPUT_POST, "password");
  //$pcr = md5($parola);
  $stmt = $conn->prepare("SELECT * ".
           "FROM utilizatori ".
           "WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  if (mysqli_num_rows ($result)) {
    $row = mysqli_fetch_row($result);
    $pcr = $row['2'];
    if (password_verify($parola, $pcr) or $pcr == md5($parola)) {
      echo 1;
      session_start();
      $id = $row['0'];
      $_SESSION['ok'] = $id;
      $query = "SELECT * FROM activitate2 WHERE id_user = '$id'";
      $result = mysqli_query($conn, $query);
      if (!mysqli_num_rows($result)) {
        $query = "INSERT INTO activitate2 (id_user, level) VALUES ('$id', '1')";
        mysqli_query($conn, $query);
      }
      // daca parola este retinuta dupa metoda veche, se actualizeaza in baza de date
      if ($pcr == md5($parola)) {
        $pcr = password_hash($parola, PASSWORD_BCRYPT);
        $query = "UPDATE utilizatori SET parola = '$pcr' WHERE id_user = '$id'";
        mysqli_query($conn, $query);
      }
    }
    else
      echo 0;
  }
  else
    echo 0;
?>
