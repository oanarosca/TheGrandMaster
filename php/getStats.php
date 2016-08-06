<?php
  // ia statisticile pentru niveluri
  function getStats ($level, $stage) {
    require_once ("connect.php");
    $conn = conectare();
    $user = $_SESSION['ok'];
    $activitate = "activitate" . $stage;
    $query = "SELECT attempts, wins, points, time FROM `$activitate` WHERE id_user = '$user' and level = '$level'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $attempts = $row['0'];
    $wins = $row['1'];
    $points = $row['2'];
    $time = $row['3'];
    $stats = '<p>Attempts: '.$attempts.'</br>Wins: '.$wins.'</br>Points: '.$points.'</br>Time: '.$time.'s</br></p>';
    return $stats;
  }
?>
