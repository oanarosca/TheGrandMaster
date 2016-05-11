<?php
  function levels () {
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
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
                <li class="img" title="Profile"><a href="profile.php"><img src="img/profile.png" alt="Profile"/></a></li>
                <li class="img" title="Leaderboard"><a href="leaderboard.php"><img src="img/trophy.png" alt="Leaderboard"/></a></li>
              </ul>
            </div> <!-- collapse -->
          </nav>
          <div class="levels"></div>
        </div> <!-- container -->
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <div class="front">
          <div id="popup">
            <i class="fa fa-times"></i>
          </div>
        </div>
        <script src="js/jquery-1.12.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/levels.js"></script>
        <script src="js/common.js"></script>
      </body>
    </html>
    <?php
  }

  function profile () {
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
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
                <li class="img" title="Profile"><a href="profile.php"><img src="img/profile.png" alt="Profile"/></a></li>
                <li class="img" title="Leaderboard"><a href="leaderboard.php"><img src="img/trophy.png" alt="Leaderboard"/></a></li>
              </ul>
            </div> <!-- collapse -->
          </nav>
          <div class="profile">
            <div class="row">
              <div class="col-md-6">
                <div class="pic">
                  <div class="remove">
                    <i class="fa fa-times"></i>
                  </div>
                  <div class="imag"><img src="img/default.png" alt="Profile picture" id="profile"/></div>
                  <div class="change">
                    <h4>Change picture</h4>
                  </div>
                </div>
              </div>
              <div class="col-md-6 info">
                <h1>username</h1>
                <h2><i class="fa fa-plus" id="friend" onclick="friend()"></i></h2>
                <div id="userData"><p>Name Surname, Place. Click here to edit.</p></div>
                <div class="row stats">
                  <div class="col-md-6">
                    <p id="rank">Rank: </p>
                    <p id="level">Level: </p>
                    <p id="attempts">Attempts: </p>
                    <p id="time">Total time: </p>
                  </div>
                  <div class="col-md-6">
                    <p id="friends">Friends: </p>
                    <p id="friendof">Friend of: </p>
                  </div>
                </div> <!-- row stats -->
              </div> <!-- info -->
            </div> <!-- row -->
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
        <script src="js/jquery-1.12.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
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
                <li class="img" title="Profile"><a href="profile.php"><img src="img/profile.png" alt="Profile"/></a></li>
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
                <th>Points</th>
                <th>Time played</th>
                <th>Level</th>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
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
        <script src="js/jquery-1.12.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/common.css">
      </head>
      <body>
        <div class="container">
          <h3><a href="index.html">Uh oh! You aren't logged in. Connect here.</a></h3>
        </div> <!-- container -->
        <div class="footer">
          <p>Made with <i class="fa fa-heart"></i> by Oana</p>
        </div>
        <script src="js/bootstrap.min.js"></script>
      </body>
    </html>
    <?php
  }
?>