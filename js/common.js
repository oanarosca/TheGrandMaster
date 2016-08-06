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
  "<p>In the example given below, three of the balls are part of the solution. However, only one is in the correct position (one red square), while two of them "+
  "are only correct in colour. Pay attention: if the first little feedback square is red, it does not mean that the first ball is correct in both colour and "+
  "position. One of the balls is, but it is not guaranteed that it is the first one.</p>"+
  "<img src='img/5.png' alt='5' id='last'/>"+
  "<p>If there are duplicate colours in the guess, they will not get a coloured square unless they correspond to"+
  " the same number of duplicate colours in the hidden combination.</p>"+
  "<p>In Stage 2, your goal is to find the solution from the first try while being given some attempts already made by the computer. The solution is"+
  " unique at all times (which means that every time there is only one correct combination).</p>"+
  "<h2>Good luck!</h2></div>";
  $(".front #popup").append(instructions);
  $("table:eq(1)").hide();
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
    async: false,
    success:
      function () {},
    error:
      function () {
        alert("Something wrong");
      }
  });
});

$("select").change(function () {
  var stage = $("option:selected").val();
  //alert(stage);
  $("table:eq("+(1-stage)+")").hide();
  $("table:eq("+stage+")").show();
});
