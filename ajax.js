// valideaza parola
$("form").submit(function () {
  $.ajax ({
    url: "php/validateL.php",
    type: "post",
    data: $(this).serialize(),
    success:
      function (response) {
        if (response == 1) {
          change();
          $(id+"form").slideUp();
        }
        else if (id === "#login ") {
          document.getElementById("lMessage").innerHTML = "Incorrect username and/or password. Click here to log in again.";
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
