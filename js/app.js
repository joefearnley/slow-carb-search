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
    autoSync: true
});

var SearchView = Backbone.View.extend({
    el: $('#form-container'),
    template: _.template($('#search-form').html()),
    events: {
        'submit form': 'search'
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
        var query = $('#query').val();
        var allowed = false;

        foodList.each(function(model){
            if(query.toUpperCase() == model.get('name').toUpperCase()) {
                allowed = true;
                return false;
            }
        });

        var resultsView = SearchResultsView();
    }
});

var SearchResultsView = Backbone.View.extend({
    el: $('#results'),
    template: _.template($('#results-details').html()),
    initialize: function (allowed) {
        this.render();
        this.data = {
            allowed: allowed
        }
    },
    render: function() {
        this.$el.html(this.template());
        return this;
    }
});

var foodList = new FoodList();
foodList.fetch();

var searchForm = new SearchView();


