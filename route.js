
(function(){
var route =angular.module('myRoute', ['ngRoute']);

 route.controller('MainController', function($scope, $route, $routeParams, $location) {
     $scope.$route = $route;
     $scope.$location = $location;
     $scope.$routeParams = $routeParams;
 })
route.config(function($routeProvider, $locationProvider) {
  
  $routeProvider
   .when('/', {
    templateUrl: '../Webroot/Template/home.html',
	 
  })
  .when('/agence', {
    templateUrl: '../Webroot/Template/agence.html',
	controller: 'agenceCtrl'
  })
  .when('/projet', {
    templateUrl: '../Webroot/Template/projet.html',
	  
  })
  .when('/contact', {
    templateUrl: '../Webroot/Template/contact.html',
	  controller: 'contactCtrl'
  })
  .otherwise('/');
$locationProvider.html5Mode(true);
});

})();