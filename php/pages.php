<?php
  function levels () {
    require_once("php/connect.php");
    $conn = conectare(); $id = $_SESSION['ok'];
    $query = "SELECT * FROM utilizatori WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
      $user = $row['username'];
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
                <li class="red" onclick="dsession()"><a href="index.html">Log out</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="levels.php">Levels</a></li>
                <li><a href="javascript:void(0)" id="instructions">Instructions</a></li>
                <!--<li class="img" title="Profile"><a href="javascript:void(0)"><img src="img/profile.png" alt="Profile"/></a></li>-->
                <li class="img" title="Leaderboard"><a href="leaderboard.php"><img src="img/trophy.png" alt="Leaderboard"/></a></li>
              </ul>
            </div> <!-- collapse -->
          </nav>
          <div class="levels">
          <?php
            require_once("getStats.php");
            require_once("getLevel.php");
            $lock = "<img src='img/lock.png'/ class='lock'>";
            $currentLevel = getLevel(); $index = 0;
            for ($j = 1; $j <= 3; $j++) {
              echo "<div class='row'>";
              for ($i = 1; $i <= 6; $i++) {
                if ($currentLevel >= ++$index) {
                  $stats = getStats($index);
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
        </div> <!-- container -->
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <div class="front">
          <div id="popup">
            <i class="fa fa-times"></i>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/levels.js"></script>
        <script src="js/common.js"></script>
      </body>
    </html>
    <?php
  }
  function profile ($user) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#000000">
        <link rel="icon" sizes="192x192" href="img/favicon.png">
        <title>Profile | TheGrandMaster</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/bdf85ecedd.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/common.css">
        <link type="text/css" rel="stylesheet" href="css/profile.css">
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
                <li class="red" onclick="dsession()"><a href="index.html">Log out</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="levels.php">Levels</a></li>
                <li><a href="javascript:void(0)" id="instructions">Instructions</a></li>
                <!--<li class="img" title="Profile"><a href="profile.php"><img src="img/profile.png" alt="Profile"/></a></li>-->
                <li class="img" title="Leaderboard"><a href="leaderboard.php"><img src="img/trophy.png" alt="Leaderboard"/></a></li>
              </ul>
            </div> <!-- collapse -->
          </nav>
          <div class="profile">
            <div class="info">
              <h1>username</h1>
              <div id="userData"><p>Name Surname, Place. Click here to edit.</p></div>
              <div class="stats">
                <p id="rank">Wins: </p>
                <p id="level">Level: </p>
                <p id="attempts">Attempts: </p>
                <p id="time">Total time: </p>
              </div> <!-- stats -->
            </div> <!-- info -->
          </div> <!-- profile -->
        </div> <!-- container -->
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <div class="front">
          <div id="popup">
            <i class="fa fa-times"></i>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/common.js"></script>
        <script src="js/profile.js"></script>
      </body>
    </html>
    <?php
  }
  function leaderboard () {
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
                <li class="red" onclick="dsession()"><a href="index.html">Log out</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="levels.php">Levels</a></li>
                <li><a href="javascript:void(0)" id="instructions">Instructions</a></li>
                <!--<li class="img" title="Profile"><a href="javascript:void(0)" onclick="profile()"><img src="img/profile.png" alt="Profile"/></a></li>-->
                <li class="img" title="Leaderboard"><a href="leaderboard.php"><img src="img/trophy.png" alt="Leaderboard"/></a></li>
              </ul>
            </div> <!-- collapse -->
          </nav>
          <div class="leaderboard">
            <h1>Champions</h1>
            <select onchange="changeCategory()">
              <option value="0">Points</option>
              <option value="1">Time played</option>
              <option value="2">Level</option>
            </select>
            <table>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Level</th>
              </tr>
              <?php
              require_once("connect.php");
              $conn = conectare();
              $query = "SELECT username, MAX(level) AS nm FROM activitate, utilizatori WHERE ".
                        "activitate.id_user = utilizatori.id_user GROUP BY username ORDER BY nm DESC";
              $result = mysqli_query($conn, $query);
              $col = mysqli_num_fields($result); $index = 1;
              while ($row = mysqli_fetch_row($result)) {
                echo "<tr><td>".$index++."</td>";
                for ($c = 0; $c < $col; $c++) {
                  if ($row[$c] == 19)
		    echo "<td><i class='fa fa-star' style='color:yellow'</i></td>";
		  else
		    echo "<td>".$row[$c]."</td>";
		}
                echo "</tr>";
              }
              ?>
            </table>
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
        <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
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
          <h3><a href="index.html">Uh oh! Something went wrong. Click here to return to the login page.</a></h3>
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
  function level ($level) {
    $idbile = ["red0", "blue1", "yellow2", "purple3", "green4", "pink5", "turqoise6", "silver7"];
    require_once("connect.php");
    $conn = conectare();
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#000000">
        <link rel="icon" sizes="192x192" href="img/favicon.png">
        <title>Level <?php echo $level; ?> | TheGrandMaster</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/bdf85ecedd.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/common.css">
        <link type="text/css" rel="stylesheet" href="css/level.css">
      </head>
      <body>
        <div class="container">
          <h1>Level <?php echo $level; ?></h1>
          <h3 id="time"></h3>
          <div class="bilute">
            <ul>
              <li></li>
              <li onclick="undoMove()"><i class="fa fa-undo" id="undo"></i></li>
              <?php
                $query = "SELECT * FROM niveluri WHERE nivel = '$level'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result))
                  $bile = $row['bilute'];
                for ($i = 0; $i <= $bile-1; $i++)
                  echo "<li><div id='$idbile[$i]' onclick='clicked(this.id)' class='b'></div></li>";
              ?>
            </ul>
          </div>
          <?php
            $query = "SELECT * FROM niveluri WHERE nivel = '$level'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
              $bilute = $row['bilute'];
              $incercari =  $row['incercari'];
              $locuri = $row['locuri'];
            }
          ?>
          <h4 id="tries"></h4>
          <?php
            echo "<table class='mare'></table>";
          ?>
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
        <?php
          echo "<p id='bilute'>" . $bilute . "</p>";
          echo "<p id='locuri'>" . $locuri . "</p>";
          echo "<p id='incercari'>" . $incercari . "</p>";
          echo "<p id='nivel'>" . $level . "</p>";
        ?>
        <!--<div id="won"><p>Congrats! You won!</p></div>
        <div id="lost"><p>Uh oh! You lost!</p></div>-->
        <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/common.js"></script>
        <script src="js/level.js"></script>
      </body>
    </html>
    <?php
  }
?>
