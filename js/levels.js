"use strict";

$(document).ready(function () {
  $(".levels:eq(1)").hide();
  if (window.innerWidth < 768)
    $(".stages h1:eq(2)").html("MP");
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
}
