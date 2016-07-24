"use strict";

// adauga instructiunile
$(document).ready(function () {

  var instructions =
  "<div><h1>Instructions</h1><p>Your goal is to guess the correct combination of balls chosen by the computer. "+
  "Colours may repeat. Click on a ball to add it to the current guess, or click on a certain spot in the current guess to place a ball there.</p>"+
  "<img src='img/1.png' alt='1'/><img src='img/2.png' alt='1'/>"+
  "<p>You can also undo a move by clicking on the undo button. By selecting a spot first, you can undo the ball placed there.</p>"+
  "<img src='img/3.png' alt='3'/><img src='img/4.png' alt='4'/>"+
  "<p>Each time you complete a row, you will be given feedback as it follows: a white square indicates the existence of a correct ball placed in "+
  "the wrong position, and a red square is placed for a ball in the guess which is correct in both colour and position.</p>"+
  "<p>In the example given below, one of the balls</p>"+
  "<img src='img/5.png' alt='5' id='last'/>"+
  "<p>If there are duplicate colours in the guess, they will not get a coloured square unless they correspond to"+
  " the same number of duplicate colours in the hidden combination.</p>"+
  "<p>In Stage 2, your goal is to find the solution from the first try while being given some attempts already made by the computer. The solution is"+
  " unique at all times (which means that every time there is only one correct combination).</p>"+
  "<h2>Good luck!</h2></div>";
  $(".front #popup").append(instructions);
});

$("#instructions").on("click", function () {
  $(".front").fadeIn(500);
});

$(".fa-times").on("click", function () {
  $(".front").fadeOut(400);
});

// inchide sesiunea cand se da click pe "Log out"
$("ul .red").on("click", function () {
  $.ajax ({
    url: "php/dsession.php",
    success:
      function () {
        //alert(response);
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
});

// deschide pagina de profil a utilizatorului
function profile (id) {
  document.location.href = "profile.php?id="+id;
};
