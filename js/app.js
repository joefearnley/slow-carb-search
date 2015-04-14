var App = {
    foods: [],
    init: function () {
        this.fetchFoods();
    },
    fetchFoods: function() {
        var self = this;
        $.get('/data/foods.json').done(function(response) {
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
        $('form#search-form').on('keyup', function (e) {
            e.preventDefault();
            var query = (this.value === undefined) ? $('#query').val() : this.value;
            if(query === '') {
                $('#results').html('');
            }
        });

        $('form#search-form').on('submit', function (e) {
            e.preventDefault();
            var query = (this.value === undefined) ? $('#query').val() : this.value;
            var allowed = self.search(query);

            var html = '';
            if (allowed) {
                var context = {
                    query: query,
                    allowed: allowed
                }
                var html = $('#results-template').html();
                var template = Handlebars.compile(html);
                html = template(context);
            }

            $('#results').html(html);
        });

        $('#info-button').click(this.toggleInfoButton);
    },
    toggleInfoButton: function () {
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
    },
    showForm: function () {
        var html = $('#search-form-template').html();
        $('#form').html(html);
    },
    search: function(query) {
        if(query === '') {
            return false;
        }

        var allowed = App.foods.filter(function(food) {
            return (query.toLowerCase() == food.name.toLowerCase());
        });

        return allowed;
    }
};