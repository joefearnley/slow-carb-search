(function(){
    var Food = Backbone.Model.extend({
        defaults: {
            allowed: false,
            allowed_in_moderation: false
        }
    });

    var FoodList = Backbone.Firebase.Collection.extend({
        model: Food,
        url: 'https://slowcarbsearch.firebaseio.com/foods',
        autoSync: true,
        search: function(query) {
            return this.filter(function(model) {
                return (query.toLowerCase() == model.get('name').toLowerCase());
            })
        }
    });

    var SearchView = Backbone.View.extend({
        el: $('#form-container'),
        template: _.template($('#search-form').html()),
        events: {
            'submit form': 'search',
            'keyup #query': 'search'
        },
        initialize: function () {
            this.render();
        },
        render: function() {
            this.$el.html(this.template());
            return this;
        },
        search: function(event) {
            event.preventDefault();

            if(this.$el.find('#query').val() === '') {
                $('#results').html('');
                return this;
            }

            var query = $('#query').val();
            var results = foodList.search(query);
            var allowed = (results.length > 0) ? true : false;

            var template = _.template($('#results-details').html());
            var html = template({
                allowed: allowed,
                query: query
            });

            $('#results').html(html);
        }
    });

    var LoginView = Backbone.View.extend({
        el: $('#form-container'),
        template: _.template($('#login-form').html()),
        events: {
            'submit form': 'login'
        },
        initialize: function () {
            this.render();
        },
        render: function() {
            this.$el.html(this.template());
            return this;
        },
        login: function(event) {
            console.log('logging in...');

        }
    });

    var Router = Backbone.Router.extend({
        routes: {
            '': 'index',
            '#/': 'index',
            'login': 'login',
            'admin': 'admin'
        },
        index: function () {
            new SearchView();
        },
        admin: function () {
            new AdminView();
        },
        login: function() {
            new LoginView();
        }
    });

    var foodList = new FoodList();
    foodList.fetch();

    new Router();
    Backbone.history.start(); // dude why?
})();