
var app = angular.module('slowcarbsearchApp', ['ngRoute', 'firebase']);

app.config(function($routeProvider) {
    $routeProvider.when('/admin', {
        templateUrl: 'partials/admin.html',
        controller: 'AdminController'
    }).when('/admin/foods/list', {
        templateUrl: 'partials/food-list.html',
        controller: 'FoodController'
    }).when('/admin/foods/edit/:id', {
        templateUrl: 'partials/food-list.html',
        controller: 'FoodController'
    }).otherwise({
        redirectTo: '/admin'
    });
});

//app.controller('IndexController', ['$scope', '$firebase',
//    function($scope, $firebase) {
//        var ref = new Firebase('https://slowcarbsearch.firebaseio.com/foods');
//        var sync = $firebase(ref);
//        var foods = sync.$asObject();
//
//        $scope.search = function() {
//            var query = angular.uppercase(this.search.input);
//            angular.forEach(foods, function(food){
//                if(!angular.isFunction(food)) {
//                    if(angular.uppercase(food.name) == query) {
//                        // food is found...is allowed
//                    }
//                }
//            });
//        }
//    }
//]);
