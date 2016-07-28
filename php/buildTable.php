<?php
  require_once("connect.php");
  $conn = conectare();
  session_start();
  $idbile = ["red0", "blue1", "yellow2", "purple3", "green4", "pink5", "turqoise6", "silver7"];
  $level = $_SESSION['level'];
  $stage = $_SESSION['stage'];
  $query = "SELECT * FROM niveluri WHERE nivel = '$level'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $bilute = $row['bilute'];
  $incercari =  $row['incercari'];
  $locuri = $row['locuri'];
  if ($stage != 3) {
    $var = mt_rand(1, 4);
    $query = "SELECT * FROM combinatii WHERE nivel = '$level' ORDER BY id_comb";
    $result = mysqli_query($conn, $query);
    for ($i = 1; $i <= $var; $i++)
      $row = mysqli_fetch_array($result);
    $id_comb = $row['id_comb'];
    $_SESSION['solution'] = $row['solutie'];
  }
  else {
    $query = "SELECT * FROM combinatii WHERE id_comb = '$level'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $id_comb = $level;
    $_SESSION['solution'] = $row['0'];
  }
  $query = "SELECT * FROM linii WHERE id_comb = '$id_comb' ORDER BY nl DESC";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result)) {
    $incercare = $row['incercare'];
    $feedback = $row['feedback'];
    echo "<tr>";
    for ($c = 0; $c < $locuri; $c++)
      echo "<td><div class='tabel' id='" . $idbile[$incercare[$c]] . "'></div></td>";
    $locuri % 2 == 0 ? $col = $locuri/2 : $col = $locuri/2+1;
    $col = (int)$col;
    echo "<td><table class='mic'>";
    $fi = 0;
    for ($i = 1; $i <= 2; $i++) {
      echo "<tr>";
      for ($c = 0; $c < $col && $fi < strlen($feedback); $c++)
        if ($feedback[$fi] == '2') {
          echo "<td class='rosu'></td>";
          $fi++;
        }
        else
          if ($feedback[$fi] == '1') {
            echo "<td class='gri'></td>";
            $fi++;
          }
          else
            echo "<td></td>";
    }
    echo "</tr></table></td></tr>";
  }
?>
