
(function () {
var app =angular.module('woop', ['myRoute','ngRoute' ]);
app.controller("mainCtrl", function($scope,$http, $q ,$rootScope, $route, $routeParams, $location) {
//$scope.val = "";
	$scope.switch = function(val)
	{
		if(val ==="")
		{
			$scope.val = "home";
		}
		$scope.val = val ;
		console.log($location);
		$location.path("/projects/woop/"+val);
	}	

});
app.controller("agenceCtrl", function($scope,$http, $q ,$rootScope, $route, $routeParams, $location) {
$scope.build = 'agence';
	$scope.val = 'agence';
});	

app.controller("contactCtrl", function($scope,$http, $q ,$rootScope, $route, $routeParams, $location) {
	$scope.val = 'contact';
	$(".form").toggleClass("");
$scope.contact = {};
	$scope.stepMail = 'form';
	$scope.sendEmail = function(){
		$scope.stepMail = 'wait';
	var data = {mail:userServices.getUserId()};
		$http.post("Webroot/script/mail.php",data)
		. success(function(data, status)
		{
		console.log(data);
			console(data)
	  	})
		.error(function(data, status)	   
		{
			
	 	 });
	};
	
});	
	
})(jQuery,angular);