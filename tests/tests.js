
$(function() {
    App.init();
});

QUnit.test('we have data', function(assert) {  
    assert.ok(App.foods.length > 0);
});

QUnit.module('Search Tests');
QUnit.test('Test empty search', function(assert) {
    var context = App.search('');
    assert.deepEqual(context.name, '');
    assert.deepEqual(context.allowed, false);
    assert.deepEqual(context.allowed_in_moderation, false);
});

QUnit.test('Test search found something', function(assert) {
    var context = App.search('Turkey');

    assert.deepEqual(context.name, 'Turkey');
    assert.deepEqual(context.allowed, true);
    assert.deepEqual(context.allowed_in_moderation, false);
});

QUnit.test('Test search found something Case does not matter', function(assert) {
    var context = App.search('turKey');

    assert.deepEqual(context.name, 'Turkey');
    assert.deepEqual(context.allowed, true);
    assert.deepEqual(context.allowed_in_moderation, false);
});

QUnit.test('Test search results only in moderation', function(assert) {
    var context = App.search('Beets');

    assert.deepEqual(context.name, 'Beets');
    assert.deepEqual(context.allowed, true);
    assert.deepEqual(context.allowed_in_moderation, true);
});

QUnit.test('Test search did not find something', function(assert) {
    var context = App.search('Pizza');

    assert.deepEqual(context.name, 'Pizza');
    assert.deepEqual(context.allowed, false);
    assert.deepEqual(context.allowed_in_moderation, false);
});