<?php
  session_start();
  require_once("php/pages.php");
  require_once("php/connect.php");
  $conn = conectare();
  $id = $_GET['id'];
  $query = "SELECT * FROM niveluri WHERE nivel = '$id'";
  $iduser = $_SESSION['ok'];
  // daca este setata variabila de sesiune, se incarca pagina, in caz contrar se
  // inchide sesiunea si se afiseaza pagina de eroare
  if (isset ($_SESSION['ok']) && mysqli_num_rows(mysqli_query($conn, $query))) {
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
    else {
      level($id);
    }
  }
  else {
    session_unset();
    session_destroy();
    error();
  }
?>
