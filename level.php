<?php
  session_start();
  require_once("php/pages.php");
  require_once("php/connect.php");
  $conn = conectare();
  $id = $_GET['id'];
  $query = "SELECT * FROM niveluri WHERE nivel = '$id'";
  if (isset ($_SESSION['ok']) && mysqli_num_rows(mysqli_query($conn, $query)))
    level($id);
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
