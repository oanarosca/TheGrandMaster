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
  $query = "SELECT * FROM niveluri WHERE nivel = '$id'";
  // daca este setata variabila de sesiune, se incarca pagina, in caz contrar se
  // inchide sesiunea si se afiseaza pagina de eroare
  if (isset ($_SESSION['ok']) && mysqli_num_rows(mysqli_query($conn, $query))) {
    $iduser = $_SESSION['ok'];
    if ($stage == '2')
      $query = "SELECT MAX(level) FROM activitate2 WHERE id_user = '$iduser'";
    else
      $query = "SELECT MAX(level) FROM activitate WHERE id_user = '$iduser'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result); $level = $row['0'];
    // daca nivelul din baza de date este mai mic decat nivelul pe care utilizatorul vrea
    // sa il acceseze, se va inchide sesiunea si se va afisa pagina de eroare
    if ($level < $id) {
      session_unset();
      session_destroy();
      error();
    }
    // altfel, se incarca pagina nivelului
    else
      level($id, $stage);
  }
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
