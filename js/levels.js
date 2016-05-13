"use strict";

$(document).ready(function () {
  var index = 0, appendedClass, currentLevel;
  var stats = "<p>Attempts: x</br>Wins: x</br>Points: x</br>Time: x</br></p>";
  var lock = "<img src='img/lock.png'/ class='lock'>";
  $.ajax ({
    url: "php/getLevel.php",
    success:
      function (response) {
        currentLevel = response;
        // add levels
        for (var j = 1; j <= 3; j++) {
          $(".levels").append("<div class='row'>");
          for (var i = 1; i <= 6; i++) {
            if (currentLevel >= ++index)
              $(".levels").append("<div class='col-md-2 col-sm-4 col-xs-6'>"+
              "<div class='level' id='"+index+"' onclick='start(this.id)'>"
              +index+"<div class='hover'><img src='img/hover.png'/>"+stats
              +"</div></div>"+"</div>");
            else
              $(".levels").append("<div class='col-md-2 col-sm-4 col-xs-6'><div class='level'>"
              +lock+"<div class='locked'><img src='img/hover.png'/>"
              +"</div></div></div>");
          }
          $(".levels").append("</div>");
        }
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
});


function start (id) {
  document.location.href = "level.php?id="+id;
}
