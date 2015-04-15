
$(function() {
    App.init();
});

QUnit.test('we have data', function(assert) {  
    assert.ok(App.foods.length > 0);
});

QUnit.module('Search Tests');
QUnit.test('Test empty search', function(assert) {
    var results = App.search('');
    assert.deepEqual(results.length, 0);
});

QUnit.test('Test search found something', function(assert) {
    var results = App.search('Turkey');
    assert.deepEqual(results.length, 1);
    assert.deepEqual(results[0].allowed_in_moderation, false);
    assert.deepEqual(results[0].name, 'Turkey');
});

QUnit.test('Test search found something Case does not matter', function(assert) {
    var results = App.search('turKey');
    assert.deepEqual(results.length, 1);
    assert.deepEqual(results[0].allowed_in_moderation, false);
    assert.deepEqual(results[0].name, 'Turkey');
});

QUnit.test('Test search did not find something', function(assert) {
    var results = App.search('Pizza');
    assert.deepEqual(results.length, 0);
});