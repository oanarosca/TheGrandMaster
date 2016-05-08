"use strict";

$(document).ready(function () {
  // doesn't display the remove picture button if picture is set to default
  var src = document.getElementById("profile").src;
  if (src.substr(src.length-11) === "default.png")
    $(".remove").css("display", "none");
});

function friend () {
  if ($("#friend").hasClass("fa-plus")) {
    $("#friend").removeClass("fa-plus");
    $("#friend").addClass("fa-minus");
  }
  else {
    $("#friend").removeClass("fa-minus");
    $("#friend").addClass("fa-plus");
  }
}

$("#userData").on("click", "p", function () {
  var contents = $(this).html();
  var value = "<input type='text' value='"+contents+"' onkeydown='check(this)' maxlength='100'/>";
  $("#userData").html(value);
});

function check (elem) {
  if(event.keyCode == 13) {
    var value = "<p>"+elem.value+"</p>";
    $("#userData").html(value);
  }
};
