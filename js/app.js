(function() {
    var app = {};
    app.firebaseRef = new Firebase('https://slowcarbsearch.firebaseio.com');

    var User = Backbone.Model.extend({
        defaults: {},
        authenticate: function(username, password) {
            app.firebaseRef.authWithPassword({
                email: username,
                password: password
            }, function(error) {
                if (error) {
                    $('#message').removeClass('hide').html(error).show();
                    return false;
                }
                return true;
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
            });
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

    var AdminView = Backbone.View.extend({
        el: $('#content'),
        template: _.template($('#admin').html()),
        initialize: function () {
            this.render();
        },
        render: function() {
            this.$el.html(this.template());
            return this;
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
                Backbone.history.navigate('admin', true);
            }
            return this;
        }
    });

    var Router = Backbone.Router.extend({
        routes: {
            '': 'index',
            'login': 'login',
            'logout': 'logout',
            'admin': 'admin',
            'add': 'add',
            'list': 'list'
        },
        requresAuth : [
            '#admin',
            '#add',
            '#edit',
            '#list'
        ],
        before: function(params, next) {
            var path = Backbone.history.location.hash;
            var needsAuth = _.contains(this.requresAuth, path);
            if(needsAuth) {
                var authData = app.firebaseRef.getAuth();
                if(authData === null) {
                    console.log('redirecting');

                    Backbone.history.navigate('login', { trigger : true });
                }
            }
        },
        index: function () {
            new SearchView();
        },
        admin: function () {
            new AdminView();
        },
        login: function() {
            console.log('creating new login view');

            new LoginView();
        },
        logout: function() {
            app.firebaseRef.unauth();
            Backbone.history.navigate('login', { trigger : true });
        }
    });

    var foods = new FoodCollection();
    foods.fetch();

    new Router();
    Backbone.history.start(); // nevermind...I see why.
})();