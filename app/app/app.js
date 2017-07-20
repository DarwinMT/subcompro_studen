var app=angular.module("subcompro",["ngRoute"]);
app.config(function($routeProvider){
	$routeProvider
	.when("/2",{
		templateUrl : "app/view/Proveedor/ViewProveedor.php",
		controller : "logicaproveedor"
	})
	.otherwise({
        template : ""
    });
});
