$("#similarfood" ).click(function() {
    $('#food').val($(this).html());
    $('.searchform').submit();
});