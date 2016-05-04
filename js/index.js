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

$(".button").click(function () {
  $(id+"input:eq("+index+")").slideUp();
  $(".button").removeClass("enabled");
});

document.onkeydown = function (e) {
	if (e.keyCode == 13) {
    $(id+"input:eq("+index+")").slideUp();
    $(".button").removeClass("enabled");
	}
}
