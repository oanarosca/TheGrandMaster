"use strict";

$(document).ready(function () {
  // doesn't display the remove picture button if picture is set to default
  var src = document.getElementById("profile").src;
  if (src.substr(src.length-11) === "default.png")
    $(".remove").css("display", "none");
});

function friend () {
  if ($("#friend").hasClass("fa-plus")) {
    $("#friend").removeClass("fa-plus");
    $("#friend").addClass("fa-minus");
  }
  else {
    $("#friend").removeClass("fa-minus");
    $("#friend").addClass("fa-plus");
  }
}
