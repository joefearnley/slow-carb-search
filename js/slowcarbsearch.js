$(function() {

    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });

    //var foods = [];
    //var firebaseReference = new Firebase('https://slowcarbsearch.firebaseio.com/foods');
    //firebaseReference.on('value', function(snapshot) {
    //    foods = snapshot.val();
    //}, function (errorObject) {
    //    $('#results').html('The read failed: ' + errorObject.code);
    //});

    //$('#search-form').submit(function(e) {
    //    e.stopImmediatePropagation();
    //
    //    var query = $('#query').val();;
    //    var template = Handlebars.compile($("#results-details").html());
    //    var allowed = false;
    //
    //    $.each(foods, function(key, food) {
    //        if(query.toUpperCase() == food.name.toUpperCase()) {
    //            allowed = true;
    //            return false;
    //        }
    //    });
    //
    //    var data = {
    //        allowed: allowed,
    //        query: query
    //    };
    //
    //    $('#results').html(template(data));
    //    return false;
    //});

    $('body').tooltip({ selector: '[data-toggle=tooltip]' });
});