
var app = angular.module('slowcarbsearchApp', ['firebase']);

app.controller('IndexController', ['$scope', '$firebase',
    function($scope, $firebase) {
        var ref = new Firebase('https://slowcarbsearch.firebaseio.com/foods');
        var sync = $firebase(ref);
        var foods = sync.$asObject();

        $scope.search = function() {
            var query = this.search.input;
            angular.forEach(foods, function(food){
                if(!angular.isFunction(food)) {
                    if(angular.uppercase(food.name) == angular.uppercase(query)) {

                    }
                }
            });
        }
    }
]);