"use strict";

$(".button").on("click", function () {
  $.ajax ({
    url: "php/dsession.php",
    async: false,
    success:
      function () {
        //alert(response);
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
});

$("form").submit(function () {
  var l = [0, 0, 0, 0, 0];
  for (var i = 0; i < 5; i++)
    l[i] = $("select:eq("+i+") option:selected").attr("value");
  $.ajax({
    url: "php/addRound.php?l0="+l[0]+"&l1="+l[1]+"&l2="+l[2]+"&l3="+l[3]+"&l4="+l[4],
    type: "post",
    data: $(this).serialize(),
    async: false,
    success:
      function (response) {
        alert("Round added successfully!");
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
  return false;
});
