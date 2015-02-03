(function() {
    var User = Backbone.Model.extend({
        defaults: {},
        firebaseRef: new Firebase('https://slowcarbsearch.firebaseio.com'),
        authenticate: function(username, password) {
            this.firebaseRef.authWithPassword({
                email: username,
                password: password
            }, function(error, authData) {
                if (error) {
                    $('#message').removeClass('hide').html(error).show();
                    return false;
                } else {
                    return new AdminView();
                }
            });
        }
    });

    var Food = Backbone.Model.extend({
        defaults: {
            allowed: false,
            allowed_in_moderation: false
        }
    });

    var FoodCollection = Backbone.Firebase.Collection.extend({
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
        el: $('#content'),
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
            var results = foods.search(query);
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
        el: $('#content'),
        template: _.template($('#login-form').html()),
        model: new User(),
        events: {
            'submit form': 'login',
            'keyup #username': 'resetMessage',
            'keyup #password': 'resetMessage'
        },
        initialize: function () {
            this.render();
        },
        render: function() {
            this.$el.html(this.template());
            return this;
        },
        resetMessage: function () {
            $('#message').html('').hide();
        },
        login: function(event) {
            event.preventDefault();
            this.resetMessage();

            var username = $('#username').val();
            var password = $('#password').val();
            if(this.model.authenticate(username, password)) {
                console.log('true');
            }

            console.log('false');

        }
    });

    var Router = Backbone.Router.extend({
        routes: {
            '': 'index',
            //'#/': 'index',
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
        },
        logout: function() {

        }
    });

    var foods = new FoodCollection();
    foods.fetch();

    new Router();
    Backbone.history.start(); // dude why?
})();