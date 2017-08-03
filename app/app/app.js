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
	.when("/6",{
		templateUrl : "app/view/Empleado/ViewEmpleado.php",
		controller : "logicaempleado"
	})
	.when("/7",{
		templateUrl : "app/view/Marca/ViewMarca.php",
		controller : "logicamarca"
	})
	.when("/4",{
		templateUrl : "app/view/Producto/ViewProducto.php",
		controller : "logicaproducto"
	})
	.when("/8",{
		templateUrl : "app/view/Bodega/ViewBodega.php",
		controller : "logicabodega"
	})
	.when("/3",{
		templateUrl : "app/view/Kardex/ViewKardex.php",
		controller : "logicakardex"
	})
	.otherwise({
        template : ""
    });
});
