$(function() {
    $('#searchform').submit(function(event) {
        event.preventDefault();

        var request = $.get('/api/search', { 'food': $('#food').val() });
        request.done(function(response) {
            if(response.success) {
                console.log(response.results);
            } else {
                console.log('This should go in the error area --> ' + response.message);    
            }
        }).fail(function(event, request, settings) {
            console.log(request);
        });
    });

    $("#similar-food" ).click(function() {
        $('#food').val($(this).html());
        $('.searchform').submit();
    });
});