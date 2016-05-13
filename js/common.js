"use strict";

$(document).ready(function () {
  // add instructions to the instructions popup
  var instructions = "<div><p>Your goal is to guess the correct combination. "+
  "Colours may repeat. Each time you complete a row, you will be given feedback as it follows: "+
  "a white square indicates the existence of a correct ball placed in the wrong position, "+
  "and a red square is placed for a ball in the guess which is correct in both colour and position. "+
  "If there are duplicate colours in the guess, they will not get a coloured square "+
  "unless they correspond to the same number of duplicate colours in the hidden combination.</p></div>";

  $(".front #popup").append(instructions);
});

$("#instructions").on("click", function () {
  $(".front").fadeIn(500);
});

$(".fa-times").on("click", function () {
  $(".front").fadeOut(400);
});

function dsession () {
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
}

function profile () {
  alert(1);
}
