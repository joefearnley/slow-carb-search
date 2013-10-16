$("#similarfood" ).click(function() {
  console.log('submitting form');
  $('#food').val($(this).html());
  $('.searchform').submit();
});