<?php
  function displayRound ($query, $d) {
    require_once("connect.php"); $conn = conectare();
    $result = mysqli_query($conn, $query);
    $n = mysqli_num_rows($result);
    for ($i = 1; $i <= $n; $i++) {
      $row = mysqli_fetch_row($result);
      $zi = substr($row['1'], 8, 2);
      $luna = substr($row['1'], 5, 2);
      $an = substr($row['1'], 0, 4);
      $ora = substr($row['1'], 11, 2);
      $min = substr($row['1'], 14, 2);
      $sec = substr($row['1'], 17, 2);
      echo "<div class='round'>";
      echo "<i></i>";
      echo "<h4>Round #" . $row['0'] . "</h4>";
      echo "<h5>On ".$zi.".".$luna.".".$an;
      echo " @ <a href='http://www.timeanddate.com/worldclock/fixedtime.html?day=".$zi."&month=".$luna."&year=".$an;
      echo "&hour=".$ora."&min=".$min."&sec=".$sec."&p1=49' target='blank'>";
      echo substr($row['1'], -8)." EET</a>";
      if ($i == 1 && $d == 1) {
        echo "<span id='time'></span></h5>";
        echo "<h5 id='left'>Time left: <span></span></h5>";
      }
      else echo "</h5>";
      echo "</div>";
    }
  }
?>
