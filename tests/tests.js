
$(function() {
    App.init();
});

QUnit.test('we have data', function(assert) {
    console.log(App.foods.length);    
    assert.ok(App.foods.length > 0);
});

QUnit.test('Search Test', function(assert) {

    var fixture = $( "#qunit-fixture" );
    fixture

    console.log(App.foods.length);    
    assert.ok(App.foods.length > 0);
});