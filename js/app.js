App = Ember.Application.create({});

App.ApplicationAdapter = DS.FirebaseAdapter.extend({
    firebase: new Firebase('https://slowcarbsearch.firebaseio.com/')
});

App.Router.map(function () {
    this.route('admin');
});

App.Food = DS.Model.extend({
    id: DS.attr('number'),
    name: DS.attr('string'),
    description: DS.attr('string'),
    allowed: DS.attr('boolean', { defaultValue: false }),
    allowed_moderation: DS.attr('boolean', { defaultValue: false }),
    createdby: DS.attr('number'),
    food_group_id: DS.attr('number'),
    created_at: DS.attr('date'),
    update_at: DS.attr('date')
});

App.IndexController = Ember.Controller.extend({
    search: '',
    actions: {
        search: function() {
            var query = this.get('query');
            console.log(query);
            //this.transitionToRoute('search', { query: query });
        }
    }
});