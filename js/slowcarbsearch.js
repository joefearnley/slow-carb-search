$(function() {
    $('#similar-food').click(function() {
        $('#food').val($(this).html());
        $('.searchform').submit();
    });

    $('#cancel-edit').click(function(event) {
        event.preventDefault();
        window.location = '/admin';
    });
});