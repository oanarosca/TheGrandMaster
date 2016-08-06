"use strict";

var time, d2;
var prim = 0, id = "#time", context = 0;

$(document).ready(function () {
  var data;
  $(".levels:eq(1), .levels:eq(2)").hide();
  if (window.innerWidth < 768)
    $(".stages h1:eq(2)").html("MP");
  var str = $(".round:eq(0) h5").html();
  data = str.substr(9, 4) + '-' + str.substr(6, 2) + '-' + str.substr(3, 2) + 'T';
  data += $(".round:eq(0) a").html().substr(0, 8);
  $("#left").hide();
  d2 = new Date(data);
  if (document.getElementById("#time") != null)
    countDown(d2, "#time");
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
