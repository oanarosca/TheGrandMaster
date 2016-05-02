"use strict";

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
