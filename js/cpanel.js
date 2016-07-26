"use strict";

$("form").submit(function () {
  var l = [0, 0, 0, 0, 0];
  for (var i = 0; i < 5; i++)
    l[i] = $("select:eq("+i+") option:selected").attr("value");
  alert(l);
  $.ajax({
    url: "php/addRound.php?l1="+l[1]+"&l2="+l[2]+"&l3="+l[3]+"&l4="+l[4]+"&l5="+l[5],
    type: "post",
    data: $(this).serialize(),
    async: false,
    success:
      function (response) {
        alert(response);
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
  return false;
});
