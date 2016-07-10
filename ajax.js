// valideaza parola
$("form").submit(function () {
  $.ajax ({
    url: $(this).attr("action"),
    type: $(this).attr("method"),
    data: $(this).serialize(),
    success:
      function (response) {
        if (response == 1) {
          change();
          $(id+"form").slideUp();
        }
        else if (id === "#login ") {
          document.getElementById("lMessage").innerHTML = "Incorrect password";
          $(id+".button").removeClass("enabled");
        }
      },
    error:
      function () {
        alert("Something wrong");
      }
  });
  return false;
});
