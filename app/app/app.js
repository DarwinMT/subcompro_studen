var app=angular.module("subcompro",["ngRoute"]);
app.config(function($routeProvider){
	$routeProvider
	.when("/2",{
		templateUrl : "app/view/Proveedor/ViewProveedor.php",
		controller : "logicaproveedor"
	})
	.when("/1",{
		templateUrl : "app/view/Usuario/ViewUsuario.php",
		controller : "logicausuarios"
	})
	.otherwise({
        template : ""
    });
});
