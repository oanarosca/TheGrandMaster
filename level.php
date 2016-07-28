<?php
  session_start();
  require_once("php/pages.php");
  require_once("php/connect.php");
  $conn = conectare();
  $id = 0;
  if (isset($_GET['id']) && isset($_GET['stage'])) {
    $id = $_GET['id'];
    $stage = $_GET['stage'];
  }
  if (isset($_GET['round']))
    $round = $_GET['round'];
  $query = "SELECT * FROM niveluri WHERE nivel = '$id'";
  // daca este setata variabila de sesiune, se incarca pagina, in caz contrar se
  // inchide sesiunea si se afiseaza pagina de eroare
  if (isset ($_SESSION['ok']) && mysqli_num_rows(mysqli_query($conn, $query))) {
    $iduser = $_SESSION['ok'];
    if ($stage == '1' || $stage == '2') {
      if ($stage == '2')
        $query = "SELECT MAX(level) FROM activitate2 WHERE id_user = '$iduser'";
      else if ($stage == '1')
      $query = "SELECT MAX(level) FROM activitate WHERE id_user = '$iduser'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result); $level = $row['0'];
      // daca nivelul din baza de date este mai mic decat nivelul pe care utilizatorul vrea
      // sa il acceseze, se va inchide sesiunea si se va afisa pagina de eroare
      if ($level < $id) {
        session_unset(); session_destroy(); error();
      }
      // altfel, se incarca pagina nivelului
      else
        level($id, $stage);
    }
    else { // ne aflam in modul multiplayer
      // verificam daca runda este terminata sau in desfasurare
      $query = "SELECT * FROM runde WHERE id_runda = '$round' AND (terminata = 2 OR terminata = 1)";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result)) {
        $query = "SELECT IFNULL(MAX(id_comb), 0) FROM activitate3 WHERE id_user = '$iduser' AND id_runda = '$round'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        // daca utilizatorul nu are activitate la runda, se seteaza si se incarca primul nivel
        if ($row['0'] == 0) {
          echo "<script>alert('finally');</script>";
          $query = "SELECT id_comb FROM combRunda WHERE id_runda = '$round'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_row($result); $id_comb = $row['0'];
          $query = "INSERT INTO activitate3 (id_user, id_runda, id_comb) VALUES ".
                   "('$iduser', '$round', '$id_comb')";
          mysqli_query($conn, $query);
        }
        level($row['0'], $stage);
      }
      else {
        session_unset(); session_destroy(); error();
      }
    }
  }
  else {
    session_unset(); session_destroy(); error();
  }
?>
