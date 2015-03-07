(function() {
    var App = {
        firebaseUrl: 'https://slowcarbsearch.firebaseio.com',
        foods: [],
        init: function () {
            this.fetchFoods();
        },
        fetchFoods: function() {
            var self = this;
            $.get('https://slowcarbsearch.firebaseio.com/foods.json').done(function(response) {
                self.foods = response;
                self.showForm();
                self.bindEvents();
            }).fail(function(response) {
                console.log('Error fetching foods: ' + response.resposeText);
            });
        },
        bindEvents: function () {
            var self = this;
            $('body').tooltip({ selector: '[data-toggle=tooltip]' });
            $('form#search-form').on('submit', function (e) {
                e.preventDefault();
                self.search();
            });

            $('#info-button').click(function () {
                $('#info').slideToggle(function () {
                    var icon = $('#info-button-icon');
                    if(icon.hasClass('fa-info-circle')) {
                        $('#info-button').addClass('open');
                        icon.removeClass('fa-info-circle').addClass('fa-close');
                    } else {
                        $('#info-button').removeClass('open');
                        icon.removeClass('fa-close').addClass('fa-info-circle');
                    }
                });
            });
        },
        showForm: function () {
            var html = $('#search-form-template').html();
            $('#form').html(html);
        },


        search: function() {
            var query = (this.value === undefined) ? $('#query').val() : this.value;

            if(query === '') {
                $('#results').html('');
            } else {
                var allowed = App.foods.filter(function(food) {
                    return (query.toLowerCase() == food.name.toLowerCase());
                });

                if (allowed) {
                    var context = {
                        query: query,
                        allowed: allowed
                    }
                    var html = $('#results-template').html();
                    var template = Handlebars.compile(html);
                    $('#results').html(template(context));
                }
            }
        }
    };

    App.init();
})();