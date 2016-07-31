function countDown () {
  var runda, d1 = new Date();
  var dif = d2-d1-3600*1000*3;
  if (dif <= 0 && context == 0) {
    if (prim == 0) {
      prim = 1; id = "#left span";
      $("#left").fadeIn();
      d2 = new Date(d2.getTime()+1000*2500);
      dif = d2-d1-3600*1000*3;
      runda = $("#time").parent().parent().children("h4").html().substr(7);
      $.ajax({
        url: "php/getRoundInfo.php?runda="+runda,
        async: false,
        success:
          function (response) {
            if (response < 6) {
              if(response == 0) response = 1;
              $("#time").html("<a href='level.php?round="+runda+"&id="+response+"&stage=3'>Enter</a>");
            }
            else $("#time").html("<span>Completed</span>");
          },
        error:
          function () {
            alert("Something wrong");
          }
      });
    }
    else {
      prim = 2; clearTimeout(cdown);
    }
  }
  if (prim != 2) {
    if (dif < 0) {
      clearTimeout(cdown);
      $(id).html("00:00:00");
      if (context == 1)
        stop(0);
    }
    else {
      var h = Math.floor(dif / 1000 / 60 / 60);
      dif -= h * 1000 * 60 * 60;
      var m = Math.floor(dif / 1000 / 60);
      dif -= m * 1000 * 60;
      var s = Math.floor(dif / 1000);
      $(id).html((h ? (h > 9 ? h : "0" + h) : "00") + ":" + (m ? (m > 9 ? m : "0" + m) : "00") + ":" + (s > 9 ? s : "0" + s));
      cdown = setTimeout(countDown, 1000);
    }
  }
};
