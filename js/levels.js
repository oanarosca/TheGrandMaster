"use strict";

function timer () {};

$(document).ready(function () {
  $(".levels:eq(1)").hide();
  if (window.innerWidth < 768)
    $(".stages h1:eq(2)").html("MP");
  timer();
});

$(".stages div").on("click", function () {
  for (var i = 0; i < 3; i++)
    if ($(".stages div:eq("+i+")").hasClass("stage-active")) {
      $(".stages div:eq("+i+")").removeClass("stage-active");
      $(".levels:eq("+i+")").fadeOut();
    }
  var index = $(this).index();
  $(".levels:eq("+index+")").delay(300).fadeIn();
  $(this).addClass("stage-active");
});

// duce utilizatorul la pagina cu nivelul pe care a facut click
function start (id) {
  if ($(".stages div:eq(0)").hasClass("stage-active"))
    document.location.href = "level.php?id="+id+"&stage=1";
  else
    document.location.href = "level.php?id="+id+"&stage=2";
};

function timer () {
  var d1 = new Date();
  var d2 = new Date("2016-07-27T12:07:00");
  var dif = d2 - d1;
  var h = Math.floor(dif / 1000 / 60 / 60);
  dif -= h * 1000 * 60 * 60;
  var m = Math.floor(dif / 1000 / 60);
  dif -= m * 1000 * 60;
  var s = Math.floor(dif / 1000);
  $("#time").html((h ? (h > 9 ? h : "0" + h) : "00") + ":" + (m ? (m > 9 ? m : "0" + m) : "00") + ":" + (s > 9 ? s : "0" + s));
  var time = setTimeout(timer, 1000);
};
