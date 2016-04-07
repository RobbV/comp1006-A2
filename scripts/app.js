$(function() {
  $( "#register" ).click(function() {
    $('.register').fadeIn(500);
    $('.login').fadeOut(0);
  });
  $( "#login" ).click(function() {
    $('.login').fadeIn(500);
    $('.register').fadeOut(0);
  });
  $( "#pages" ).click(function() {
    $('.pages').fadeIn(500);
    $('.add-page').fadeOut(0);
    $('.users').fadeOut(0);
  });
  $( "#add-page" ).click(function() {
    $('.add-page').fadeIn(500);
    $('.users').fadeOut(0);
    $('.pages').fadeOut(0);
  });
  $( "#users" ).click(function() {
    $('.users').fadeIn(500);
    $('.add-page').fadeOut(0);
    $('.pages').fadeOut(0);
  });
// end DOM ready
});
