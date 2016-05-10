"use strict";

var index = 1, id = "#login ";

$(document).ready(function () {
  $("h1").delay(500).fadeIn("slow");
  $(".login").delay(1000).fadeIn("slow");
});

$(".login").on("click", function () {
  $(".front").fadeIn(500);
  $("#register").hide();
});

$("#login header p").click(function () {
  id = "#register ", index = 3;
  $("#login").fadeOut();
  $("#register").fadeIn();
});

$("input").on("input", function() {
  //index = $(this).index();
  //alert(index);
  if ($(this).val())
    $(".button").addClass("enabled");
  else
    $(".button").removeClass("enabled");
});

function next () {
  $(id+"form:eq("+index+")").slideUp();
  $(id+"button").removeClass("enabled");
  if (!index)
    $(".input a, .input p").fadeIn("slow");
  index--;
}
