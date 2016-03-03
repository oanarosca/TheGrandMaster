$(document).ready(function() {
  $('.bilute').hide();
  $('table').hide();
});

function show () {
  $('.bilute').fadeIn();
  $('table').delay(450).fadeIn();
}

function stop () {

}

var lineIndex, colIndex;

function reset () {
  $('td').empty();
  $('td').css("padding", "14px");
  $('td').css("width", "16px");
  $('td').css("height", "16px");
  s = [0, 0, 0, 0, 0]; u = [0, 0, 0, 0, 0];
  // cifrele solutiei si cifrele utilizatorului
  lineIndex = colIndex = 0;
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
  alert(sol);
  while (sol > 9) {
    s[++i] = Math.floor(sol % 10);
    sol /= 10;
  }
  s[++i] = Math.floor(sol % 10);
}

function newGame () {
  reset(); show(); generare();
}

function plasare (corecte, aproapeCorecte) {
  var i;
}

function eval () {
  var i, j, corecte = 0, aproapeCorecte = 0;
  for (i = 1; i <= 4; i++)
    if (s[i] == u[i])
      corecte++;
    else {
      for (j = 1; j <= 4; j++)
        if (s[i] == u[j])
          aproapeCorecte++;
    }
  if (lineIndex == 10 && corecte != 4) {
    alert("You lost!"); stop();
  }
  else if (corecte == 4) {
    alert("You won!"); stop();
  }
  else
    plasare(corecte, aproapeCorecte);
}

function clicked (id) { // click facut pe biluta
    $("table tr:eq("+lineIndex+") td:eq("+colIndex+")").append("<div id='"+id+"'></div>");
    $("table tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding", "0px");
    $("table tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding-right", "28px");
    colIndex++;
    u[4-colIndex+1] = Number(id[id.length-1]);
    if (colIndex == 4) {
      lineIndex++; colIndex = 0;
      eval();
    }
};
