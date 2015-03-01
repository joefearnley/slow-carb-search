(function() {

    Handlebars.registerHelper('each', function(context, options) {
        var array = '';
        for(var i = 0, j = context.length; i < j; i++) {
            array = array + options.fn(context[i]);
        }
        return array;
    });

    var Admin = {
        firebaseRef: null,
        firebaseUrl: 'https://slowcarbsearch.firebaseio.com',
        loginFormTemplate: $('#login-form-template'),
        listTemplate: $('#food-list-template'),
        loadingListTemplate: $('#loading-list-template'),
        addFormTemplate: $('#add-form-template'),
        editFormTemplate: $('#edit-form-template'),
        el: $('#content'),
        init: function () {
            // check for auth
            this.el.html(this.loginFormTemplate.html());
            this.bindEvents();
        },
        fetchFoods: function() {
            var self = this;
            this.el.html(this.loadingListTemplate.html());
            $.get('https://slowcarbsearch.firebaseio.com/foods.json').done(function(response) {
                self.foods = response;
                self.showList();
            }).fail(function(response) {
                console.log('Error fetching foods: ' + response.resposeText);
            });
        },
        login: function() {
            var self = this;
            var ref = new Firebase(this.firebaseUrl);
            ref.authWithPassword({
                email: $('#username').val(),
                password: $('#password').val()
            }, function(error) {
                if (error) {
                    console.log('Login Failed!', error);
                } else {
                    self.fetchFoods();
                }
            }, {
                remember: 'sessionOnly'
            });
        },
        showList: function () {
            var self = this;

            // update html

            self.el.html(self.listTemplate.html());
            // set click events



            //$('#add-food').on('click', function(e) {
            //    e.preventDefault();
            //    self.addFood();
            //});

            //$('#logout').on('click', function(e) {
            //    e.preventDefault();
            //    self.logout();
            //});
        },
        logout: function () {

        }
    };

    Admin.init();
})();

//    var User = Backbone.Model.extend({
//        defaults: {},
//        authenticate: function(username, password) {
//            app.firebaseRef.authWithPassword({
//                email: username,
//                password: password
//            }, function(error) {
//                if (error) {
//                    $('#message').removeClass('hide').html(error).show();
//                } else {
//                    window.location.hash = 'admin/food/list';
//                }
//            });
//        }
//    });
//
//    var Food = Backbone.Model.extend({
//        defaults: {
//            allowed_in_moderation: false
//        },
//        url: 'https://slowcarbsearch.firebaseio.com/foods'
//    });
//
//    var FoodCollection = Backbone.Firebase.Collection.extend({
//        model: Food,
//        url: 'https://slowcarbsearch.firebaseio.com/foods',
//        autoSync: false,
//        search: function(query) {
//            return this.filter(function(model) {
//                return (query.toLowerCase() == model.get('name').toLowerCase());
//            });
//        }
//    });
//
//    var SearchView = Backbone.View.extend({
//        el: $('#content'),
//        template: _.template($('#search-form').html()),
//        events: {
//            'submit form': 'search',
//            'keyup #query': 'search'
//        },
//        initialize: function () {
//            this.render();
//        },
//        render: function() {
//            this.$el.html(this.template());
//            return this;
//        },
//        search: function(event) {
//            event.preventDefault();
//
//            if(this.$el.find('#query').val() === '') {
//                $('#results').html('');
//                return this;
//            }
//
//            var query = $('#query').val();
//            var results = app.foods.search(query);
//            var allowed = (results.length > 0) ? true : false;
//
//            var template = _.template($('#results-details').html());
//            var html = template({
//                allowed: allowed,
//                query: query
//            });
//
//            $('#results').html(html);
//        }
//    });
//
//    var AdminView = Backbone.View.extend({
//        el: $('#content'),
//        template: _.template($('#admin').html()),
//        initialize: function () {
//            this.render();
//        },
//        render: function() {
//            this.$el.html(this.template());
//            return this;
//        }
//    });
//
//    var ListFoodsView = Backbone.View.extend({
//        el: $('#content'),
//        template: _.template($('#food-list').html()),
//        initialize: function () {
//            this.render();
//        },
//        render: function() {
//            console.log(app.foods.length);
//
//            var html = this.template({
//                foods: app.foods.toJSON()
//            });
//            this.$el.html(html);
//            return this;
//        }
//    });
//
//    var AddFoodView = Backbone.View.extend({
//        el: $('#content'),
//        template: _.template($('#add-food').html()),
//        events: {
//            'submit form#add-food-form': 'addFood',
//            'click #cancel-add': 'cancel'
//        },
//        initialize: function () {
//            this.render();
//        },
//        render: function() {
//            this.$el.html(this.template());
//            return this;
//        },
//        addFood: function(event) {
//            event.preventDefault();
//            var now = new Date();
//            var date = now.getFullYear() + '-' + now.getMonth()+1 + '-' + now.getDate();
//            var time = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
//            var dateTime = date + ' ' + time;
//            var user = app.firebaseRef.getAuth().password.email;
//
//            app.foods.add({
//                name: $('#name').val(),
//                description: $('#description').val(),
//                allowed_moderation: $('#allowed-in-moderation').is(':checked'),
//                created_at: dateTime,
//                updated_at: dateTime,
//                createdby: user
//            });
//        },
//        cancel: function (event) {
//            event.preventDefault();
//            window.location.hash = 'admin/food/list'
//        }
//    });
//
//    var EditFoodView = Backbone.View.extend({
//        el: $('#content'),
//        template: _.template($('#edit-food').html()),
//        events: {
//            'submit form#add-food-form': 'saveFood',
//            'click #cancel-add': 'cancel'
//        },
//        initialize: function () {
//            this.render();
//        },
//        render: function() {
//            var html = this.template({
//                foods: app.foods.toJSON()
//            });
//            this.$el.html(html);
//            return this;
//        },
//        saveFood: function(event) {
//            event.preventDefault();
//            var now = new Date();
//            var date = now.getFullYear() + '-' + now.getMonth()+1 + '-' + now.getDate();
//            var time = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
//            var dateTime = date + ' ' + time;
//            var user = app.firebaseRef.getAuth().password.email;
//
//            app.foods.add({
//                name: $('#name').val(),
//                description: $('#description').val(),
//                allowed_moderation: $('#allowed-in-moderation').is(':checked'),
//                created_at: dateTime,
//                updated_at: dateTime,
//                created_by: user
//            });
//        },
//        cancel: function (event) {
//            event.preventDefault();
//            window.location.hash = 'admin/food/list'
//        }
//    });
//
//    var LoginView = Backbone.View.extend({
//        el: $('#content'),
//        template: _.template($('#login-form').html()),
//        model: new User(),
//        events: {
//            'submit form': 'login',
//            'keyup #username': 'resetMessage',
//            'keyup #password': 'resetMessage'
//        },
//        initialize: function () {
//            this.render();
//        },
//        render: function() {
//            this.$el.html(this.template());
//            return this;
//        },
//        resetMessage: function () {
//            $('#message').html('').hide();
//        },
//        login: function(event) {
//            event.preventDefault();
//            this.resetMessage();
//            var username = $('#username').val();
//            var password = $('#password').val();
//            this.model.authenticate(username, password);
//            return this;
//        }
//    });
//
//    var Router = Backbone.Router.extend({
//        routes: {
//            '': 'index',
//            'login': 'login',
//            'logout': 'logout',
//            'admin': 'admin',
//            'admin/food/add': 'add',
//            'admin/food/edit/:id': 'edit',
//            'admin/food/list': 'list'
//        },
//        requresAuth : [
//            '#admin',
//            '#admin/food/add',
//            '#admin/food/edit',
//            '#admin/food/list'
//        ],
//        after: function(params, next) {
//            var path = Backbone.history.location.hash;
//            var needsAuth = _.contains(this.requresAuth, path);
//            if(needsAuth) {
//                var authData = app.firebaseRef.getAuth();
//                if(authData === null) {
//                    window.location.hash = 'login';
//                }
//            }
//        },
//        index: function () {
//            new SearchView();
//        },
//        admin: function () {
//            new AdminView();
//        },
//        login: function() {
//            new LoginView();
//        },
//        logout: function() {
//            app.firebaseRef.unauth();
//            window.location.hash = 'login';
//        },
//        list: function() {
//            new ListFoodsView();
//        },
//        add: function () {
//            new AddFoodView();
//        },
//        edit: function () {
//            new EditFoodView();
//        }
//    });
//
//    var app = {};
//    app.firebaseRef = new Firebase('https://slowcarbsearch.firebaseio.com');
//
//    app.foods = new FoodCollection();
//    app.foods.fetch();
//
//    new Router();
//    Backbone.history.start();
//})();