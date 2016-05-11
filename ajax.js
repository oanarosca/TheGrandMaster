$("form").submit(function () {
  $.ajax ({
    url: $(this).attr("action"),
    type: $(this).attr("method"),
    data: $(this).serialize(),
    success:
      function () {
        change();
        $(id+"form").slideUp();
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
  return false;
});
