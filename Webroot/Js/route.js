
(function(){
var route =angular.module('myRoute', ['ngRoute']);

 route.controller('MainController', function($scope, $route, $routeParams, $location) {
     $scope.$route = $route;
     $scope.$location = $location;
     $scope.$routeParams = $routeParams;
 })
route.config(function($routeProvider, $locationProvider) {
  
  $routeProvider
   .when('/projects/woop/', {
    templateUrl: '../woop/Webroot/Template/step1.html',
	 
  })
  .when('/projects/woop/agence', {
    templateUrl: '../woop/Webroot/Template/agence.html',
	controller: 'agenceCtrl'
  })
  .when('/projects/woop/projet', {
    templateUrl: '../woop/Webroot/Template/projet.html',
	  
  })
  .otherwise('/projects/woop/');
$locationProvider.html5Mode(true);
});

})();