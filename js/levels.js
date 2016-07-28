"use strict";

function timer () {};

var time, d2;

$(document).ready(function () {
  var data;
  $(".levels:eq(1), .levels:eq(2)").hide();
  if (window.innerWidth < 768)
    $(".stages h1:eq(2)").html("MP");
  var str = $(".round:eq(0) h5").html();
  data = str.substr(9, 4) + '-' + str.substr(6, 2) + '-' + str.substr(3, 2) + 'T';
  data += $(".round:eq(0) a").html().substr(0, 8);
  //var d = new Date("2016-07-27T12:07:00");
  d2 = new Date(data);
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
  var dif = d2-d1-3600*1000*3;
  if (dif <= 0) {
    clearInterval(time);
    var runda = $("#time").parent().parent().children("h4").html().substr(7);
    $.ajax({
      url: "php/getRoundInfo.php?runda="+runda,
      async: false,
      success:
        function (response) {
          if (response < 6)
            $("#time").html("<a href='level.php?round="+runda+"&id="+response+"&stage=3'>"+(response-1)+"/5</a>");
          else $("#time").html("<span>Completed</span>");
        },
      error:
        function () {
          alert("Something wrong");
        }
    });
  }
  else {
    var h = Math.floor(dif / 1000 / 60 / 60);
    dif -= h * 1000 * 60 * 60;
    var m = Math.floor(dif / 1000 / 60);
    dif -= m * 1000 * 60;
    var s = Math.floor(dif / 1000);
    $("#time").html((h ? (h > 9 ? h : "0" + h) : "00") + ":" + (m ? (m > 9 ? m : "0" + m) : "00") + ":" + (s > 9 ? s : "0" + s));
    time = setTimeout(timer, 1000);
  }
};
