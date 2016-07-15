"use strict";

$(document).ready(function () {
  $(".levels:eq(1)").hide();
});

$(".stages div").on("click", function () {
  var index = 1-$(this).index();
  $(".stages div:eq("+index+")").removeClass("stage-active");
  $(".levels:eq("+index+")").fadeOut();
  index = 1-index;
  $(".levels:eq("+index+")").delay(300).fadeIn();
  $(this).addClass("stage-active");
});

// duce utilizatorul la pagina cu nivelul pe care a facut click
function start (id) {
  document.location.href = "level.php?id="+id;
}
