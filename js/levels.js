"use strict";

$(".stages div").on("click", function () {
  var index = 1-$(this).index();
  $(".stages div:eq("+index+")").removeClass("stage-active");
  $(this).addClass("stage-active");
});

// duce utilizatorul la pagina cu nivelul pe care a facut click
function start (id) {
  document.location.href = "level.php?id="+id;
}
