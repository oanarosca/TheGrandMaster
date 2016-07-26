"use strict";

$("form").submit(function () {
  $.ajax({
    url: $(this).attr("action"),
    type: "post",
    data: $(this).serialize(),
    async: false,
    success:
      function (response) {
        if (response == 1) {
          document.location.href = "";
        }
        else
          alert("Wrong username and/or password");
      },
    error:
      function (response) {
        alert(response);
      }
  });
  return false;
});
