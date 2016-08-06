<?php
  // functiile care construiesc paginile
  function levels () {
    require_once("php/connect.php");
    $conn = conectare(); $id = $_SESSION['ok'];
    $query = "SELECT * FROM utilizatori WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result); $user = $row['username'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#000000">
        <link rel="icon" sizes="192x192" href="img/favicon.png">
        <title>Levels | TheGrandMaster</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/bdf85ecedd.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/common.css">
        <link type="text/css" rel="stylesheet" href="css/levels.css">
      </head>
      <body>
        <div class="container">
          <nav class="navbar navbar-inverse">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle"
                data-toggle="collapse" data-target="#meniu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div> <!-- header -->
            <div class="collapse navbar-collapse" id="meniu">
              <ul class="nav navbar-nav navbar-left">
                <li class="red"><a href="index.html">Log out</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="levels.php">Levels</a></li>
                <li><a href="javascript:void(0)" id="instructions">Instructions</a></li>
                <!--<li class="img" title="Profile"><a href="javascript:void(0)"><img src="img/profile.png" alt="Profile"/></a></li>-->
                <li class="img" title="Leaderboard"><a href="leaderboard.php?round=0"><img src="img/trophy.png" alt="Leaderboard"/></a></li>
              </ul>
            </div> <!-- collapse -->
          </nav>
          <div class="stages">
            <div class="one stage-active">
              <h1>STAGE ONE</h1>
            </div>
            <div class="two">
              <h1>STAGE TWO</h1>
            </div>
            <div class="multip">
              <h1>MULTIPLAYER</h1>
            </div>
          </div>
          <div class="levels">
          <?php
            require_once("getStats.php");
            require_once("getLevel.php");
            $lock = "<img src='img/lock.png'/ class='lock'>";
            $currentLevel = getLevel(1); $index = 0;
            for ($j = 1; $j <= 3; $j++) {
              echo "<div class='row'>";
              for ($i = 1; $i <= 6; $i++) {
                if ($currentLevel >= ++$index) {
                  $stats = getStats($index, 1);
                  //echo $stats;
                  echo "<div class='col-md-2 col-sm-4 col-xs-6'><div class='level' id='$index' onclick='start(this.id)'>"
                  .$index."<div class='hover'><img src='img/hover.png'/>".$stats.
                  "</div></div></div>";
                }
                else
                  echo "<div class='col-md-2 col-sm-4 col-xs-6'><div class='level'>".
                  $lock."<div class='locked'><img src='img/hover.png'/>".
                  "</div></div></div>";
              }
              echo "</div>";
            }
          ?>
          </div>
          <div class="levels">
            <?php
              require_once("getStats.php");
              require_once("getLevel.php");
              $lock = "<img src='img/lock.png'/ class='lock'>";
              $currentLevel = getLevel(2); $index = 0;
              for ($j = 1; $j <= 3; $j++) {
                echo "<div class='row'>";
                for ($i = 1; $i <= 6; $i++) {
                  if ($currentLevel >= ++$index) {
                    $stats = getStats($index, 2);
                    //echo $stats;
                    echo "<div class='col-md-2 col-sm-4 col-xs-6'><div class='level' id='$index' onclick='start(this.id)'>"
                    .$index."<div class='hover'><img src='img/hover.png'/>".$stats.
                    "</div></div></div>";
                  }
                  else
                    echo "<div class='col-md-2 col-sm-4 col-xs-6'><div class='level'>".
                    $lock."<div class='locked'><img src='img/hover.png'/>".
                    "</div></div></div>";
                }
                echo "</div>";
              }
            ?>
          </div>
          <div class="levels">
            <h2>Current or upcoming rounds</h2>
            <?php
              require_once("displayRound.php");
              $query = "SELECT * FROM runde WHERE ".
                       "TIMEDIFF(DATE_ADD(STR_TO_DATE(data, '%Y-%m-%dT%k:%i:%s'), INTERVAL 2500 SECOND), NOW()) > 0 ".
                       "ORDER BY data";
              displayRound($query, 1);
            ?>
            <h2>Past rounds</h2>
            <?php
              require_once("displayRound.php");
              $query = "SELECT * FROM runde WHERE ".
                       "TIMEDIFF(DATE_ADD(STR_TO_DATE(data, '%Y-%m-%dT%k:%i:%s'), INTERVAL 2500 SECOND), NOW()) < 0 ".
                       "ORDER BY data DESC";
              displayRound($query, 2);
            ?>
          </div>
        </div> <!-- container -->
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <div class="front">
          <div id="popup">
            <i class="fa fa-times"></i>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/countdown.js"></script>
        <script src="js/levels.js"></script>
        <script src="js/common.js"></script>
      </body>
    </html>
    <?php
  }
  function leaderboard ($round) {
    $score1 = 5000;
    $ldif = 5000;
    $pps = 2;
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#000000">
        <link rel="icon" sizes="192x192" href="img/favicon.png">
        <title>Leaderboard | TheGrandMaster</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/bdf85ecedd.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/common.css">
        <link type="text/css" rel="stylesheet" href="css/leaderboard.css">
      </head>
      <body>
        <div class="container">
          <nav class="navbar navbar-inverse">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle"
                data-toggle="collapse" data-target="#meniu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div> <!-- header -->
            <div class="collapse navbar-collapse" id="meniu">
              <ul class="nav navbar-nav navbar-left">
                <li class="red"><a href="index.html">Log out</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="levels.php">Levels</a></li>
                <li><a href="javascript:void(0)" id="instructions">Instructions</a></li>
                <li class="img" title="Leaderboard"><a href="leaderboard.php?round=0"><img src="img/trophy.png" alt="Leaderboard"/></a></li>
              </ul>
            </div> <!-- collapse -->
          </nav>
          <div class="leaderboard">
            <h1>Champions</h1>
            <table>
              <thead>
                <th>#</th>
                <th>Username</th>
                <?php
                  if ($round == 0)
                    echo "<th>Level</th><th title='Points per attempt'>PPA*</th>";
                  else
                    echo "<th>Points</th>"
                ?>
              </thead>
              <tbody>
              <?php
              require_once("connect.php");
              $conn = conectare();
              if ($round == 0) {
                $query = "SELECT activitate1.id_user, username, level, total/attempts
                          FROM activitate1, utilizatori, (
                              SELECT id_user, MAX(level)-1 AS ml
                              FROM activitate1
                              GROUP BY id_user
                              ) AS t_im
                          WHERE (activitate1.id_user = t_im.id_user) AND (level = ml) AND (activitate1.id_user = utilizatori.id_user)
                          ORDER BY ml DESC, total/attempts DESC";
                $start = 1;
              }
              else {
                $query = "SELECT username, SUM($score1+$ldif*(ind-1)-timp*$pps*ind) FROM activitate3, utilizatori ".
                         "WHERE id_runda = '$round' AND timp > 0 AND activitate3.id_user = utilizatori.id_user";
                $start = 0;
              }
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
              ?>
              </tbody>
            </table>
            <?php
              if ($round == 0)
                echo "<p>* Points per attempt</p>";
            ?>
          </div>
        </div> <!-- container -->
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <div class="front">
          <div id="popup">
            <i class="fa fa-times"></i>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/common.js"></script>
      </body>
    </html>
    <?php
  }
  function error () {
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#000000">
        <link rel="icon" sizes="192x192" href="img/favicon.png">
        <title>Error | TheGrandMaster</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/bdf85ecedd.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/common.css">
        <link type="text/css" rel="stylesheet" href="css/error.css">
      </head>
      <body>
        <div class="container">
          <h1>Congrats!</h1>
          <h2>You just broke the Internet.</h2>
          <h4>Or I did something terribly wrong. Or you tried to change the URL to a nonexistent page.
            If you were already logged in, click <a href="levels.php">here</a> to return to the levels page.
            If not, click <a href="index.html">here</a> to return to the login page.</h4>
        </div> <!-- container -->
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/common.js"></script>
      </body>
    </html>
    <?php
  }
  function level ($level, $stage, $round) {
    $idbile = ["red0", "blue1", "yellow2", "purple3", "green4", "pink5", "turqoise6", "silver7"];
    require_once("connect.php");
    $conn = conectare();
    $_SESSION['level'] = $level;
    $_SESSION['stage'] = $stage;
    if ($stage == 3) {
      $query = "SELECT nivel FROM combinatii WHERE id_comb = '$level'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_row($result);
      $level = $row['0'];
    }
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#000000">
        <link rel="icon" sizes="192x192" href="img/favicon.png">
        <title><?php if ($stage == 3) echo "Multiplayer Round #".$round; else echo "Level " . $level; ?> | TheGrandMaster</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/bdf85ecedd.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/common.css">
        <link type="text/css" rel="stylesheet" href="css/level.css">
      </head>
      <body>
        <div class="container">
          <h1><?php if ($stage == 3) echo "Multiplayer Round #".$round; else echo "Level " . $level; ?></h1>
          <h3 id="left"><span></span> until end of round</h3>
          <h3 id="time"></h3>
          <div class="bilute">
            <ul>
              <li></li>
              <li onclick="undoMove()"><i class="fa fa-undo" id="undo"></i></li>
              <?php
                $query = "SELECT * FROM niveluri WHERE nivel = '$level'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                $bile = $row['bilute'];
                for ($i = 0; $i <= $bile-1; $i++)
                  echo "<li><div id='$idbile[$i]' onclick='clicked(this.id)' class='b'></div></li>";
              ?>
            </ul>
          </div>
          <h4 id="tries"></h4>
          <table class="mare"></table>
        </div>
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <div class="won">
          <div id="popup">
          </div>
        </div>
        <div class="lost">
          <div id="popup">
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/common.js"></script>
        <script src="js/level.js"></script>
        <script src="js/countdown.js"></script>
      </body>
    </html>
    <?php
  }
  function cpanel () {
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#000000">
        <link rel="icon" sizes="192x192" href="img/favicon.png">
        <title>Control Panel | TheGrandMaster</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/bdf85ecedd.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/common.css">
        <link type="text/css" rel="stylesheet" href="css/sudo.css">
      </head>
      <body>
        <div class="container">
          <h3>Add round</h3>
          <h5>sudo</h5>
          <form action="php/addRound.php" method="post" id="addRound">
            <input type="text" name="date" placeholder="YYYY-MM-DD"/>
            <input type="text" name="time" placeholder="HH:MM:SS"/>
            <?php
              for ($i = 1; $i <= 5; $i++) {
                echo "<select name='levels'>";
                for ($j = 1; $j <= 18; $j++)
                  echo "<option value='$j'>".$j."</option>";
                echo "</select>";
              }
            ?>
            <button type="submit">Go</button>
          </form>
          <div class="button"><a href="sudo.html">Log out</a></div>
        </div>
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/cpanel.js"></script>
      </body>
    </html>
  <?php
  }
?>
