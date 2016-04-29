"use strict";

$(document).ready(function () {
  var index = 0;
  for (var j = 1; j <= 3; j++) {
    $(".levels").append("<div class='row'></div>");
    for (var i = 1; i <= 6; i++)
      $(".levels").append("<div class='col-md-2 nivel'>"+(++index)+"</div>");
  }
});
