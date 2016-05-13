"use strict";

var copieIncercari, colIndex, bilute, incercari, started, locuri, sol, str, col, time;
var sec, m, h;
var s = [0, 0, 0, 0, 0, 0, 0]; //cifrele solutiei
var u = [0, 0, 0, 0, 0, 0, 0]; //cifrele utilizatorului
function show () {};
function reset () {};

var won = "<h1>YOU WON!</h1><div class='levels'><a href='levels.php'>Levels</a></div>"+
"<h3 class='time'></h3><h3 id='points'></h3><div class='bottom'><i class='fa fa-undo' onclick='reset()'></i>"+
"<i class='fa fa-arrow-right' onclick='next()'></i>";
var lost = "<h1>YOU LOST!</h1><div class='levels'><a href='levels.php'>Levels</a></div>"+
"<h3 class='time'></h3><div class='bottom'><i class='fa fa-undo' onclick='reset()'></i>";

$(document).ready(function() {
  bilute = document.getElementById("bilute").innerHTML;
  incercari = document.getElementById("incercari").innerHTML;
  locuri = document.getElementById("locuri").innerHTML;
  copieIncercari = incercari;
  $(".won #popup").append(won);
  $(".lost #popup").append(lost);
  reset(); show();
  generare();
});

function next () {
  var current = document.getElementById("nivel").innerHTML;
  var next = Number(current)+1;
  document.location.href = "level.php?id="+next;
}

function timer () {
  sec++;
  if (sec >= 60) {
    s = 0;
    m++;
    if (m >= 60) {
      m = 0;
      h++;
    }
  }
  $("#time").html((h ? (h > 9 ? h : "0" + h) : "00") + ":" + (m ? (m > 9 ? m : "0" + m) : "00") + ":" + (sec > 9 ? sec : "0" + sec));
  time = setTimeout(timer, 1000);
};

function reset () {
  $(".won").fadeOut(500);
  $(".lost").fadeOut(500);
  $("table").html("");
  str = "<tr>";
  for (var c = 1; c <= locuri; c++)
    str += "<td></td>";
  locuri % 2 == 0 ? col = locuri/2 : col = locuri/2+1;
  str += "<td><table class='mic'>";
  for (var i = 1; i <= 2; i++) {
    str += "<tr>";
    for (var c = 1; c <= col; c++)
      str += "<td></td>";
  }
  str += "</tr></table></td></tr>";
  $(".mare").append(str);
  var x = document.getElementsByClassName("b");
  for (var i = 0; i <= bilute-1; i++)
    $(x[i]).css("cursor", "pointer");
  for (var i = 0; i <= locuri-1; i++)
    s[i] = u[i] = 0;
  incercari = copieIncercari; colIndex = 0;
  started = false;
  $("h4").html("You have "+incercari+" more tries");
  $("#time").html("00:00:00");
  sec = m = h = 0;
}

function show () {
  $(".bilute").hide();
  $("table").hide();
  $("#tries").hide();
  $(".bilute").delay(500).fadeIn();
  $("#tries").delay(725).fadeIn();
  $("table").delay(950).fadeIn();
};

function stop () {
  clearTimeout(time);
  var x = document.getElementsByClassName("b");
  for (var i = 0; i <= bilute-1; i++)
    $(x[i]).css("cursor", "default");
}

// numarul generat trebuie sa aiba cifre de la 0 la 7, pentru a corespunde celor 8 bilute
function altul (val) {
  var v = val;
  while (v) {
    if (v % 10 > bilute-1)
      return true;
    v /= 10;
  }
  return false;
}

// generare si frecventa pentru solutie
function generare () {
  var p = 1;
  for (var i = 1; i <= locuri-1; i++) p *= 10;
  do {
    sol = Math.floor((Math.random() * p * (bilute-1)) + p);
  } while (altul(sol));
  var i = 0;
  while (sol > 9) {
    s[++i] = Math.floor(sol % 10);
    sol /= 10;
  }
  s[++i] = Math.floor(sol % 10);
  //alert(s);
}

function newGame () {
  reset(); show(); generare();
}

function feedback (corecte, aproapeCorecte) {
  var l, c, ls;
  for (l = 0; l <= 1; l++) {
    for (c = 0; c <= col-1; c++) {
      var bg = "";
      if (corecte) {
        corecte--; bg = "#c0392b";
      }
      else if (aproapeCorecte) {
        aproapeCorecte--; bg = "#bdc3c7";
      }
      $(".mic tr:eq("+ l +") td:eq("+ c +")").css("background", bg);
    }
  }
};

function evaluare () {
  var i, j, corecte = 0, aproapeCorecte = 0;
  var ms = [0, 0, 0, 0, 0, 0, 0], mu = [0, 0, 0, 0, 0, 0, 0];
  for (i = 1; i <= locuri; i++)
    if (s[i] == u[i])
      corecte++, mu[i] = ms[i] = 1;
  for (i = 1; i <= locuri; i++)
    for (j = 1; j <= locuri; j++)
      if (s[i] == u[j] && mu[j] == 0 && ms[i] == 0) {
        aproapeCorecte++; ms[i] = mu[j] = 1;
        break;
      }
  feedback(corecte, aproapeCorecte);
  if (!incercari && corecte != locuri) {
    $("#popup .time").html("Time: "+$("#time").html());
    $(".lost").fadeIn(500); stop();
  }
  else if (corecte == locuri) {
    $("#popup .time").html("Time: "+$("#time").html());
    $("#points").html("Points per minute: ");
    $(".won").fadeIn(500); stop();
    $.ajax ({
      url: "php/won.php",
      success:
        function () {
        },
      error:
        function () {
          alert("Something wrong");
        }
    });
  }
  else {
    $(str).insertBefore(".mare tr:eq(0)");
    var display = " tries";
    if (incercari == 1) display = " try";
    document.getElementById("tries").innerHTML = "You have "+incercari+" more"+display;
  }
}

function clicked (id) { // click facut pe biluta
  if ($("#"+id).css("cursor") != "default") {
    if (!started) timer(), started = true;
    $(".mare tr:eq(0) td:eq("+colIndex+")").append("<div class='tabel' id='"+id+"'></div>");
    //$(".mare tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding", "0");
    //$(".mare tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding-right", "0");
    colIndex++;
    u[locuri-colIndex+1] = Number(id[id.length-1]);
    if (colIndex == locuri) {
      incercari--; colIndex = 0;
      evaluare();
    }
  }
};

function undoMove () {
  if (colIndex)
    colIndex--;
  $(".mare tr:eq(0) td:eq("+colIndex+")").empty();
  u[locuri-colIndex] = 0;
};
