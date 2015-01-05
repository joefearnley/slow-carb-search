$(function() {
    $("#similar-food" ).click(function() {
        $('#food').val($(this).html());
        $('.searchform').submit();
    });
});