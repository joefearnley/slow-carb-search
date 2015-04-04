
$(function() {
    App.init();
});


QUnit.test('test we have data', function(assert) {
    assert.ok(App.foods.length > 0);
});