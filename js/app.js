var App = {
    foods: [],
    dataUrl: 'http://joefearnley.com/slow-carb-search/data/foods.json',
    init: function () {
        this.fetchFoods();
    },
    fetchFoods: function() {
        var self = this;
        $.get(self.dataUrl).done(function(response) {
            self.foods = response;
            self.showForm();
            self.bindEvents();
        }).fail(function(response) {
            console.log('Error fetching foods: ' + response.resposeText);
        });
    },
    bindEvents: function () {
        $('body').tooltip({ selector: '[data-toggle=tooltip]' });
        $('form#search-form').on('keyup', this.handleFormKeyUp);
        $('form#search-form').on('submit', this.handleFormSubmission);
        $('#info-button').click(this.toggleInfoButton);
    },
    handleFormKeyUp: function (e) {
        e.preventDefault();
        var query = (this.value === undefined) ? $('#query').val() : this.value;
        if(query === '') {
            $('#results').html('');
        }
    },
    handleFormSubmission: function (e) {
        e.preventDefault();
        var self = App;
        var query = (this.value === undefined) ? $('#query').val() : this.value;

        if(query === '') {
            return false;
        }

        var context = self.search(query);
        var html = $('#results-template').html();
        var template = Handlebars.compile(html);
        $('#results').html(template(context));
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
        $('#form').html($('#search-form-template').html());
    },
    search: function(query) {
        var context = {
            name: query,
            allowed: false,
            allowed_in_moderation: false
        };

        var results = App.foods.filter(function(food) {
            return (query.toLowerCase() == food.name.toLowerCase());
        });

        if(results.length > 0) {
            context.name = results[0].name;
            context.allowed = true;
            context.allowed_in_moderation = results[0].allowed_in_moderation;
        }

        return context;
    }
};