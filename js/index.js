"use strict";

var index, id = "#login ";

$(document).ready(function () {
  $("h1").delay(500).fadeIn("slow");
  $(".login").delay(1000).fadeIn("slow");
});

$(".login").on("click", function () {
  $(".front").fadeIn(500);
});

$("#login header p").click(function () {
  id = "#register ";
  $("#login").fadeOut();
});

$("input").on("input", function() {
  index = $(this).index();
  if ($(this).val())
    $(".button").addClass("enabled");
  else
    $(".button").removeClass("enabled");
});

function next () {
  $(id+"input:eq("+index+")").slideUp();
  $(id+".button").removeClass("enabled");
  if (!index) {
    $(id+".button").slideUp();
    $(".input a, .input p").fadeIn("slow");
  }
}

document.onkeydown = function (e) {
	if (e.keyCode == 13)
    next();
}
