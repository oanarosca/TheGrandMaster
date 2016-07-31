<?php
  // verifica daca un nume de utilizator introdus la inregistrare apartine deja unui alt cont
  $username = filter_input(INPUT_POST, 'val');
  require_once("connect.php");
  $conn = conectare();
  $stmt->prepare("SELECT * ".
          "FROM utilizatori ".
          "WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result(); $stmt->close();
  if (mysqli_num_rows ($result))
    echo 0;
  else
    echo 1;
?>
