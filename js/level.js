"use strict";

var copieIncercari, colIndex, bilute, incercari, started, locuri, sol, str, col, time;
var sec, m, h;
var ramase;
var s = [0, 0, 0, 0, 0, 0, 0]; // cifrele solutiei
var u = [0, 0, 0, 0, 0, 0, 0]; // cifrele utilizatorului
// incercarile utilizatorului perfect pentru stabilirea punctajului
var up = [0, 2, 3, 3, 3, 4, 4, 4, 5, 5, 6, 5, 7, 6, 6 , 7, 6, 6, 7];
function show () {};
function reset () {};
function generare () {};

function play () {
  reset(); show(); generare();
};

var won = "<h1>YOU WON!</h1><div class='levels'><a href='levels.php'>Levels</a></div>"+
"<h3 class='time'></h3><h3 id='points'></h3><div class='bottom'><i class='fa fa-undo' onclick='play()'></i>"+
"<i class='fa fa-arrow-right' onclick='next()'></i>";
var lost = "<h1>YOU LOST!</h1><div class='levels'><a href='levels.php'>Levels</a></div>"+
"<h3 class='time'></h3><div class='bottom'><i class='fa fa-undo' onclick='play()'></i>";

var current = document.getElementById("nivel").innerHTML;

// se preiau numarul de bilute, incercari, locuri, se ataseaza html-ul pentru castig si pierdere
$(document).ready(function() {
  bilute = document.getElementById("bilute").innerHTML;
  incercari = document.getElementById("incercari").innerHTML;
  locuri = document.getElementById("locuri").innerHTML;
  copieIncercari = incercari;
  $(".won #popup").append(won);
  $(".lost #popup").append(lost);
  play();
});

// se trece la urmatorul nivel, sau se revine la pagina cu niveluri daca jocul s-a completat
function next () {
  var next = Number(current)+1;
  if (next == 19)
    document.location.href = "levels.php";
  else
    document.location.href = "level.php?id="+next;
}

function timer () {
  // creste numarul de secunde, minute, ore, dupa cum este cazul
  sec++;
  if (sec >= 60) {
    sec = 0;
    m++;
    if (m >= 60) {
      m = 0;
      h++;
    }
  }
  // se afiseaza cu zerouri cand valoarea este mai mica decat 10
  $("#time").html((h ? (h > 9 ? h : "0" + h) : "00") + ":" + (m ? (m > 9 ? m : "0" + m) : "00") + ":" + (sec > 9 ? sec : "0" + sec));
  time = setTimeout(timer, 1000);
};

// se reseteaza jocul
function reset () {
  // se actualizeaza numarul de incercari pentru nivelul curent in baza de date
  $.ajax ({
    url: "php/attempts.php?level="+current,
    success:
      function (response) {
        //alert(response);
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
  // se ascund popup-urile si se reseteaza continutul tabelului
  $(".won").fadeOut(500);
  $(".lost").fadeOut(500);
  $("table").html("");
  // se construieste tabelul cu ajutorul numarului de locuri
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
  // se pune cursor specific pentru bilute
  var x = document.getElementsByClassName("b");
  for (var i = 0; i <= bilute-1; i++)
    $(x[i]).css("cursor", "pointer");
  // se reinitializeaza vectorii cu cifrele solutiei si cele ale utilizatorului
  for (var i = 0; i <= locuri-1; i++)
    s[i] = u[i] = 0;
  // se reinitializeaza numarul de incercari si indexul pentru coloana in tabel
  incercari = copieIncercari; colIndex = 0; ramase = locuri;
  // cronometrul nu este pornit inca
  started = false;
  // se reinitializeaza afisarea numarului de incercari si a timpului scurs
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
  // se opreste cronometrul iar bilutele primesc cursorul default
  clearTimeout(time);
  var x = document.getElementsByClassName("b");
  for (var i = 0; i <= bilute-1; i++)
    $(x[i]).css("cursor", "default");
}

// numarul generat trebuie sa aiba cifre de la 0 la bilute-1
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
  // gasim un numar potrivit
  for (var i = 1; i <= locuri-1; i++) p *= 10;
  do {
    sol = Math.floor((Math.random() * p * (bilute-1)) + p);
  } while (altul(sol));
  // ii punem cifrele in vectorul de solutie
  var i = 0;
  while (sol > 9) {
    s[++i] = Math.floor(sol % 10);
    sol /= 10;
  }
  s[++i] = Math.floor(sol % 10);
  //alert(s);
}

// coloreaza patratelele de feedback din partea dreapta
// rosu - una dintre bilute face parte din solutie si este pe pozitia corecta
// gri - una dintre bilute face parte din solutie, dar nu este pe pozitia corecta
function feedback (corecte, aproapeCorecte) {
  var l, c;
  for (l = 0; l <= 1; l++) {
    for (c = 0; c <= col-1; c++) {
      var bg = "";
      if (corecte) { // intai se coloreaza cu rosu, apoi cu gri
        corecte--; bg = "#c0392b";
      }
      else if (aproapeCorecte) {
        aproapeCorecte--; bg = "#bdc3c7";
      }
      $(".mic tr:eq("+ l +") td:eq("+ c +")").css("background", bg);
    }
  }
};

// evalueaza o incercare a utilizatorului
function evaluare () {
  var i, j, corecte = 0, aproapeCorecte = 0;
  var ms = [0, 0, 0, 0, 0, 0, 0], mu = [0, 0, 0, 0, 0, 0, 0]; // vector de cifre marcate
  // daca valorile coincid, inseamna ca utilizatorul a ghicit una dintre bilute si pozitia ei
  for (i = 1; i <= locuri; i++)
    if (s[i] == u[i])
      corecte++, mu[i] = ms[i] = 1; // se marcheaza pozitiile ca fiind deja analizate
  for (i = 1; i <= locuri; i++)
    for (j = 1; j <= locuri; j++)
      // daca am gasit doua valori neanalizate care coincid, inseamna ca utilizatorul a ghicit una dintre bilute, dar nu si pozitia ei
      if (s[i] == u[j] && mu[j] == 0 && ms[i] == 0) {
        aproapeCorecte++; ms[i] = mu[j] = 1;
        break;
      }
  // se coloreaza patratelele de feedback
  feedback(corecte, aproapeCorecte);
  // daca nu au mai ramas incercari si nu s-a ghicit din ultima incercare, utilizatorul a pierdut
  if (!incercari && corecte != locuri) {
    $("#popup .time").html("Time: "+$("#time").html());
    $(".lost").fadeIn(500); stop();
  }
  else if (corecte == locuri) {
    // daca a castigat, se calculeaza numarul de puncte si se afiseaza
    $("#popup .time").html("Time: "+$("#time").html());
    var secunde = sec+m*60+h*3600;
    var points = (up[current] / (copieIncercari-incercari) * 100000) / secunde;
    $("#points").html("Points: "+Math.floor(points));
    $(".won").fadeIn(500); stop();
    // se trimit numarul de puncte si timpul, pentru a se face actualizari in baza de date, daca este cazul
    $.ajax ({
      url: "php/won.php?level="+current+"&points="+Math.floor(points)+"&time="+secunde,
      success:
        function (response) {
          //alert(response);
        },
      error:
        function () {
          alert("Something wrong");
        }
    });
  }
  // au mai ramas incercari, jocul nu s-a terminat
  else {
    // se actualizeaza pe ecran numarul de incercari ramase
    $(str).insertBefore(".mare tr:eq(0)");
    var display = " tries";
    if (incercari == 1) display = " try";
    document.getElementById("tries").innerHTML = "You have "+incercari+" more"+display;
  }
}

var cellIndex = -1, rowIndex = -1;

// click facut pe un loc in tabel
$(document).on("click", function(event) {
  if ($(event.target).closest(".mare tr td").length) {
    var cell = $(event.target).closest(".mare tr td");
    cellIndex = $(cell).index();
    var row = $(cell).closest("tr");
    rowIndex = $(row).index();
    if (!rowIndex)
      $(".mare tr:eq("+rowIndex+") td:eq("+cellIndex+")").css("background", "#bdc3c7");
  }
  else {
    $(".mare tr:eq("+rowIndex+") td:eq("+cellIndex+")").css("background", "#000000");
    cellIndex = rowIndex = -1;
  }
});

// click facut pe biluta
function clicked (id) {
  // daca se poate adauga biluta (nu este gata jocul)
  if ($("#"+id).css("cursor") != "default") {
    // daca este primul click, se porneste cronometrul
    if (!started) timer(), started = true;
    // daca este selectata o casuta din tabel si este goala, se pune biluta pe locul respectiv
    if (cellIndex != -1 && rowIndex == 0 && !$(".mare tr:eq(0) td:eq("+cellIndex+")").html()) {
      $(".mare tr:eq(0) td:eq("+cellIndex+")").append("<div class='tabel' id='"+id+"'></div>");
      $(".mare tr:eq(0) td:eq("+cellIndex+")").css("background", "#000000");
      u[locuri-cellIndex+1] = Number(id[id.length-1]);
      cellIndex = rowIndex = -1;
    }
    // se adauga biluta respectiva in tabel si creste indexul de coloana
    else {
      // se cauta prima casuta goala de pe linie
      colIndex = 0;
      while ($(".mare tr:eq(0) td:eq("+colIndex+")").html() && colIndex <= locuri-1)
        colIndex++;
      $(".mare tr:eq(0) td:eq("+colIndex+")").append("<div class='tabel' id='"+id+"'></div>");
      $(".mare tr:eq(0) td:eq("+colIndex+")").css("background", "#000000");
      colIndex++;
      u[locuri-colIndex+1] = Number(id[id.length-1]);
    }
    ramase--;
    // daca s-a completat o linie, scade numarul de incercari ramase si se face evaluarea
    if (!ramase) {
      ramase = locuri;
      incercari--; colIndex = 0;
      evaluare();
    }
  }
};

// elimina ultima biluta adaugata, mai putin daca aceasta este ultima de pe linie
function undoMove () {
  if (cellIndex != -1 && rowIndex == 0) {
    $(".mare tr:eq(0) td:eq("+cellIndex+")").empty();
    $(".mare tr:eq(0) td:eq("+cellIndex+")").css("background", "#000000");
    u[locuri-cellIndex+1] = 0;
    cellIndex = rowIndex = -1;
  }
  else {
    colIndex = locuri-1;
    while (!$(".mare tr:eq(0) td:eq("+colIndex+")").html() && colIndex >= -1)
      colIndex--;
    $(".mare tr:eq(0) td:eq("+colIndex+")").empty();
    $(".mare tr:eq(0) td:eq("+colIndex+")").css("background", "#000000");
    u[locuri-colIndex+1] = 0; // se sterge si din vectorul cu cifrele utilizatorului
  }
  ramase++;
};
