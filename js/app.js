//var app = app || {};

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

var SearchResultsView = Backbone.View.extend({
    el: $('#results'),
    template: _.template($('#results-details').html()),
    initialize: function (model, query) {
        this.render();
        console.log(model);
    },
    render: function() {
        this.$el.html(this.template());
        return this;
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

var foodList = new FoodList();
foodList.fetch();

var searchForm = new SearchView();
