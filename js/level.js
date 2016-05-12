"use strict";

var lines, colIndex, bilute, incercari, locuri;
var s = [0, 0, 0, 0, 0, 0, 0]; //cifrele solutiei
var u = [0, 0, 0, 0, 0, 0, 0]; //cifrele utilizatorului
function show () {};
function reset () {};

$(document).ready(function() {
  show();
  bilute = document.getElementsById("bilute").innerHTML;
  incercari = document.getElementsById("incercari").innerHTML;
  locuri = document.getElementsById("locuri").innerHTML;
  generare();
});

function reset () {
  $("td").empty();
  var x = document.getElementsByClassName("b");
  for (var i = 0; i <= bilute-1; i++)
    $(x[i]).css("cursor", "pointer");
    for (var i = 0; i <= locuri-1; i++)
      s[i] = u[i] = 0;
  lines = colIndex = 0;
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
    if (v % 10 > 7)
      return true;
    v /= 10;
  }
  return false;
}

// generare si frecventa pentru solutie
function generare () {
  sol = Math.floor(Math.random() * 7000 + 1000);
  do {
    sol = Math.floor(Math.random() * 7000 + 1000);
  } while (altul(sol));
  var i = 0;
  //alert(sol);
  while (sol > 9) {
    s[++i] = Math.floor(sol % 10);
    sol /= 10;
  }
  s[++i] = Math.floor(sol % 10);
  //s = [0, 2, 6, 3, 1];
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
  //alert(m);
  for (i = 1; i <= locuri; i++)
    for (j = 1; j <= locuri; j++)
      if (s[i] == u[j] && mu[j] == 0 && ms[i] == 0) {
        aproapeCorecte++; ms[i] = mu[j] = 1; //alert("ms"+ms+"i"+i);
        //alert("mu"+mu+"j"+j);
        break;
      }
  feedback(corecte, aproapeCorecte);
  if (lines == incercari && corecte != locuri) {
    /*prompt('lost');*/ stop();
  }
  else if (corecte == locuri) {
    /*prompt('won');*/ stop();
  }
}

function clicked (id) { // click facut pe biluta
  if ($("#"+id).css("cursor") != "default") {
    $(".mare tr:eq("+0+") td:eq("+colIndex+")").append("<div id='"+id+"'></div>");
    //$(".mare tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding", "0px");
    //$(".mare tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding-right", "0px");
    colIndex++;
    u[locuri-colIndex+1] = Number(id[id.length-1]);
    if (colIndex == locuri) {
      lines++; colIndex = 0;
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
