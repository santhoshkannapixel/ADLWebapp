var app = angular.module('myApp', ['ngRoute']);

app.controller('myCtrl', function($scope) {
    $scope.firstName = "John";
    $scope.lastName = "Doe";
});

app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        template : "main.htm"
    })
    .when("/red-d", {
        template : "red.htm"
    })
    .when("/green", {
        template : "green.htm"
    })
    .when("/blue", {
        template : "blue.htm"
    });
});