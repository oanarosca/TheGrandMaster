<?php
  function table ($round, $query) {
    require_once("connect.php");
    $conn = conectare();
    echo "<table><thead><th>#</th><th>Username</th>";
    if ($round == 0) {
      echo "<th>Level</th><th title='Points per attempt'>PPA*</th>";
      $start = 1;
    }
    else {
      echo "<th>Points</th>";
      $start = 0;
    }
    echo "</thead><tbody>";
    $result = mysqli_query($conn, $query);
    $col = mysqli_num_fields($result); $index = 1;
    while ($row = mysqli_fetch_row($result)) {
      echo "<tr><td>".$index++."</td>";
      for ($c = $start; $c < $col; $c++) {
        if ($c == 2) $row[$c]++;
        if ($round == 0 && $row[$c] == 19 && $c == 2)
          echo "<td><img src='img/crown.png' class='crown'/></td>";
        else {
          if ($c == 3)
            $row[$c] = number_format($row[$c], 2, ".", "");
          echo "<td>".$row[$c]."</td>";
        }
      }
      echo "</tr>";
    }
    echo "</tbody></table>";
  }
?>
