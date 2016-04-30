"use strict";

$(document).ready(function () {
  var index = 0;
  var paragraphs = "<p>Attempts: x</br>Wins: x</br>Points: x</br>Time: x</br></p>";
  for (var j = 1; j <= 3; j++) {
    $(".levels").append("<div class='row'>");
    for (var i = 1; i <= 6; i++)
      $(".levels").append("<div class='col-md-2 col-sm-4 col-xs-6'><div class='level'>"
      +(++index)+"<div class='hover'><img src='img/hover.png'/>"+paragraphs+"</div></div>"+"</div>");
    $(".levels").append("</div>");
  }
});
