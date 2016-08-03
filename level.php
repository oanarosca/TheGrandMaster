<?php
  session_start();
  require_once("php/pages.php");
  require_once("php/connect.php");
  $conn = conectare();
  $id = $round = 0;
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
      // sa il acceseze se va afisa pagina de eroare
      if ($level < $id)
        error();
      // altfel, se incarca pagina nivelului
      else
        level($id, $stage, $round);
    }
    else { // ne aflam in modul multiplayer
      // verificam daca runda este terminata sau in desfasurare
      $query = "SELECT * FROM runde WHERE id_runda = '$round' AND ".
               "TIMEDIFF(DATE_ADD(STR_TO_DATE(data, '%Y-%m-%dT%k:%i:%s'), INTERVAL 2500 SECOND), NOW()) > 0";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result)) {
        $query = "SELECT IFNULL(MAX(id_comb), 0), IFNULL(activitate3.ind, 1)
                  FROM activitate3, (
                  SELECT id_user, IFNULL(MAX(id_comb), 0) AS mi
                  FROM activitate3
                  GROUP BY id_user) AS t_mi
                  WHERE (activitate3.id_user = t_mi.id_user) AND (id_comb = mi) AND id_runda = '$round' AND (activitate3.id_user = '$iduser')";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        // daca utilizatorul schimba id-ul in link
        if ($row['1'] != $id)
          error();
        else {
          // daca utilizatorul nu are activitate la runda, se seteaza si se incarca primul nivel
          if ($row['0'] == 0) {
            $query = "SELECT id_comb FROM combRunda WHERE id_runda = '$round'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result); $id_comb = $row['0'];
            $query = "INSERT INTO activitate3 (id_user, id_runda, id_comb, ind) VALUES ".
                     "('$iduser', '$round', '$id_comb', '1')";
            mysqli_query($conn, $query);
          }
          level($row['0'], $stage, $round);
        }
      }
      else
        error();
    }
  }
  else
    error();
?>
