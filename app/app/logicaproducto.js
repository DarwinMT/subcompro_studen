app.controller("logicabodega",function($scope,$http){
	$scope.Titulo="Producto";
	$scope.Mensaje="";
	$scope.list_permisos={};

	$scope.newandedit="0";
	$scope.get_permisos=function() {
		$http.get("get_permisos_proveedor")
			.success(function(data){
				data.forEach(function(permiso){
					if(permiso.Id_menu==4){
						$scope.list_permisos=permiso;
					}
				});
				console.log($scope.list_permisos);
			})
			.error(function(data){
				console.log(data);
		});
	};

	$scope.int_producto=function(){
		var data_producto={
			nombre_prod:$scope.nombre_prod, 
			categoria_prod: $scope.categoria_prod,
			precio_prod:$scope.precio_prod, 
			codigo_prod:$scope.codigo_prod, 
			estado_prod:'1'
		}
		$http.post("save_producto",data_producto)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_productos();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al guardar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_productos();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	
	};

	$scope.clear_data=function(){
		$scope.nombre_prod=""; 
		$scope.categoria_prod="";
		$scope.precio_prod=""; 
		$scope.codigo_prod=""; 

		$scope.aux_edit_producto={};

	};
	$scope.cmb_estado="1";
	$scope.txt_buscar="";
	$scope.lista_productos=[];
	$scope.get_productos=function(){
		var filtro={
			estado:$scope.cmb_estado,
			buscar: $scope.txt_buscar
		};
		$http.post("list_producto",filtro)
		.success(function(data){
			$scope.lista_productos=data;
		});

	};

	$scope.activar_inactivar=function(item){
		console.log(item);
		var aux_producto={};
		var estado="1";
		if(item.estado_prod=="1"){
			estado="0";
		}else{
			estado="1";
		}
		aux_producto={
			id_prod: item.id_prod,
			estado_prod: estado
		};

		$http.post("activar_inactivar_producto",aux_producto)
		.success(function(data){
			console.log(data);
			$scope.get_productos();
		});


	};

	$scope.aux_edit_producto={};
	$scope.aux_edicion="0";
	$scope.init_edit=function(item){
		console.log(item);

		$scope.aux_edit_producto=item;
		$scope.newandedit="1";
		$scope.aux_edicion="1";

		$scope.nombre_prod=item.nombre_prod; 
		$scope.categoria_prod=item.categoria_prod;
		$scope.precio_prod=item.precio_prod; 
		$scope.genero_per=item.genero_per; 
		$scope.codigo_prod=item.codigo_prod;

	};

	$scope.save_edit=function() {
		var data_producto={
			id_prod:$scope.aux_edit_producto.id_prod,
			nombre_prod:$scope.nombre_prod, 
			categoria_prod: $scope.categoria_prod,
			precio_prod:$scope.precio_prod, 
			genero_per:$scope.genero_per, 
			codigo_prod:$scope.codigo_prod,
			estado_prod:'1'
		}

		$http.post("save_edit_producto",data_producto)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_productos();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al modificar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_productos();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	};

});




