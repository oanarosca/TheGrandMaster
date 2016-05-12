"use strict";

var copieIncercari, colIndex, bilute, incercari, locuri, sol, str;
var s = [0, 0, 0, 0, 0, 0, 0]; //cifrele solutiei
var u = [0, 0, 0, 0, 0, 0, 0]; //cifrele utilizatorului
function show () {};
function reset () {};

$(document).ready(function() {
  bilute = document.getElementById("bilute").innerHTML;
  incercari = document.getElementById("incercari").innerHTML;
  locuri = document.getElementById("locuri").innerHTML;
  copieIncercari = incercari;
  reset(); show();
  generare();
});

function reset () {
  $("table").html("");
  var col;
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
}

function show () {
  $(".bilute").hide();
  $("table").hide();
  $(".bilute").delay(500).fadeIn();
  $("table").delay(950).fadeIn();
};

function stop () {
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
}

function newGame () {
  reset(); show(); generare();
}

function feedback (corecte, aproapeCorecte) {
  /*var l, c, ls;
  ls = (lineIndex-1)*2;
  for (l = ls; l <= ls+1; l++) {
    for (c = 0; c <= 1; c++) {
      bg = '';
      if (corecte) {
        corecte--; bg = '#c0392b';
      }
      else if (aproapeCorecte) {
        aproapeCorecte--; bg = '#bdc3c7';
      }
      //alert (corecte, aproapeCorecte);
      $(".mic tr:eq("+ l +") td:eq("+ c +")").css('background-color', bg);
    }
  }*/
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
    /*prompt('lost');*/ stop();
  }
  else if (corecte == locuri) {
    /*prompt('won');*/ stop();
  }
}

function clicked (id) { // click facut pe biluta
  if ($("#"+id).css("cursor") != "default") {
    $(".mare tr:eq(0) td:eq("+colIndex+")").append("<div class='tabel' id='"+id+"'></div>");
    //$(".mare tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding", "0");
    //$(".mare tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding-right", "0");
    colIndex++;
    u[locuri-colIndex+1] = Number(id[id.length-1]);
    if (colIndex == locuri) {
      incercari--; colIndex = 0;
      evaluare();
      if (incercari)
        $(str).insertBefore(".mare tr:eq(0)");
    }
  }
};

function undoMove () {
  if (colIndex)
    colIndex--;
  $(".mare tr:eq(0) td:eq("+colIndex+")").empty();
  u[locuri-colIndex] = 0;
};
