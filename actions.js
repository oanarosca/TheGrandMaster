$(document).ready(function() {
  $('.bilute').hide();
  $('table').hide();
});

function show () {
  $('.bilute').fadeIn();
  $('table').delay(450).fadeIn();
}

function generare () {
}

function newGame () {
  show(); generare();
}

var lineIndex = 0;
var colIndex = 0;

function clicked (id) {
  $("table tr:eq("+lineIndex+") td:eq("+colIndex+")").append("<div id='"+id+"'></div>");
  $("table tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding", "0px");
  $("table tr:eq("+lineIndex+") td:eq("+colIndex+")").css("padding-right", "28px");
  colIndex++;
};
