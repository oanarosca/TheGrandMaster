"use strict";

$(document).ready(function () {
  var index = 0, appendedClass, currentLevel = 1;
  var stats = "<p>Attempts: x</br>Wins: x</br>Points: x</br>Time: x</br></p>";
  var lock = "<img src='img/lock.png'/ class='lock'>";
  var instructions = "<div><p>Your goal is to guess the correct combination. "+
  "Colours may repeat. Each time you complete a row, you will be given feedback as it follows: "+
  "a white square indicates the existence of a correct ball placed in the wrong position, "+
  "and a red square is placed for a ball in the guess which is correct in both colour and position. "+
  "If there are duplicate colours in the guess, they will not get a coloured square "+
  "unless they correspond to the same number of duplicate colours in the hidden combination.</p></div>";

  // add levels
  for (var j = 1; j <= 3; j++) {
    $(".levels").append("<div class='row'>");
    for (var i = 1; i <= 6; i++) {
      if (currentLevel >= ++index)
        $(".levels").append("<div class='col-md-2 col-sm-4 col-xs-6'><div class='level'>"
        +index+"<div class='hover'><img src='img/hover.png'/>"+stats
        +"</div></div>"+"</div>");
      else
        $(".levels").append("<div class='col-md-2 col-sm-4 col-xs-6'><div class='level'>"
        +lock+"<div class='locked'><img src='img/hover.png'/>"
        +"</div></div></div>");
    }
    $(".levels").append("</div>");
  }
  // add instructions to the instructions popup
  $("#popup").append(instructions);
});

$("#instructions").on("click", function () {
  $(".front").fadeIn(500);
});

$(".fa-times").on("click", function () {
  $(".front").fadeOut(400);
});
