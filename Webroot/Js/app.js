
(function () {
var app =angular.module('woop', ['myRoute','ngRoute' ]);
app.controller("mainCtrl", function($scope,$http, $q ,$rootScope, $route, $routeParams, $location) {
$scope.val = "";
	$scope.agence = "equipe";
	$scope.switch = function(val)
	{
		
		if(val ==="")
		{
			$scope.val = "home";
		}
		$scope.val = val ;
		console.log($scope.val);
		$location.path("/projects/woop/"+val);
	}	

});
	


})(jQuery,angular);