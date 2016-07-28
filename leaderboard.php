<?php
  session_start();
  require_once("php/pages.php");
  // daca este setata variabila de sesiune, se incarca pagina, in caz contrar se
  // inchide sesiunea si se afiseaza pagina de eroare
  if (isset ($_SESSION['ok']))
    leaderboard();
  else
    error();
?>
