"use strict";

var index = 1, id = "#login ", pass = "";

$(document).ready(function () {
  $("h1").delay(500).fadeIn("slow");
  $(".login").delay(1000).fadeIn("slow");
});

$(".login").on("click", function () {
  $(".front").fadeIn(500);
  $("#register").hide();
});

$("#login header p").click(function () {
  if ($(this).html() == "Don't have an account yet? Click here.") {
    id = "#register ", index = 2;
    $("#login").fadeOut();
    $("#register").fadeIn();
  }
});

$("input").on("input", function() {
  if ($(this).val())
    $(".button").addClass("enabled");
  else
    $(".button").removeClass("enabled");
});

$("form").on("keyup keypress", function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

function change () {
  if ($(id+".button").hasClass("enabled")) {
    $(id+"input:eq("+index+")").slideUp();
    $(id+".button:eq("+index+")").slideUp();
    $(id+".button").removeClass("enabled");
    if (!index)
      $(".input a, .input p").fadeIn("slow");
    index--;
  }
  $("header p").html("Fill the fields below");
};

function phpValidate (dir, data, type) {
  $.post (dir, 'val=' + data, function (response) {
   if (response == 1)
     change();
   else {
     if (id === "#register ")
       document.getElementById("rMessage").innerHTML = "Username is already taken.";
     else if (type === "username")
       document.getElementById("lMessage").innerHTML = "Incorrect username";
     $(id+".button").removeClass("enabled");
   }
 });
};

function next () {
  var input = id+"input:eq("+index+")"; var str = $(input).val();
  if ($(input).attr("name") === "username")
    if (username(str))
      if (id === "#register ")
        phpValidate("php/validateR.php", str, "username");
      else phpValidate("php/validateLu.php", str, "username");
    else
      $("header p").html("Username must be between 4 and 20 characters long.");
  else
    if (password(str))
      if (id === "#register ")
        if ($(input).attr("name") === "password") {
          pass = str; change();
        }
        else
          if (pass !== str) // passwords don't match
            document.getElementById("rMessage").innerHTML = "Passwords don't match.";
          else
            change();
    else
      $("header p").html("Password must be between 6 and 50 characters long.");
};
