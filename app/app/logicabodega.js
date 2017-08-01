app.controller("logicabodega",function($scope,$http){
	$scope.Titulo="Bodega";
	$scope.Mensaje="";
	$scope.list_permisos={};

	$scope.newandedit="0";
	$scope.get_permisos=function() {
		$http.get("get_permisos_proveedor")
			.success(function(data){
				data.forEach(function(permiso){
					if(permiso.Id_menu==8){
						$scope.list_permisos=permiso;
					}
				});
				console.log($scope.list_permisos);
			})
			.error(function(data){
				console.log(data);
		});
	};

	$scope.int_bodega=function(){
		var data_bodega={
			descripcion_bod:$scope.descripcion_bod, 
			direccion_bod: $scope.direccion_bod,
			estado_bod:'1'
		}
		$http.post("save_bodega",data_bodega)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_bodegas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al guardar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_bodegas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	
	};

	$scope.clear_data=function(){
		$scope.descripcion_bod=""; 
		$scope.direccion_bod="";
		$scope.precio_prod=""; 
		$scope.codigo_prod=""; 

		$scope.aux_edit_producto={};

	};
	$scope.cmb_estado="1";
	$scope.txt_buscar="";
	$scope.lista_bodegas=[];
	$scope.get_bodegas=function(){
		var filtro={
			estado:$scope.cmb_estado,
			buscar: $scope.txt_buscar
		};
		$http.post("list_bodegas",filtro)
		.success(function(data){
			$scope.lista_bodegas=data;
		});

	};

	$scope.activar_inactivar=function(item){
		console.log(item);
		var aux_bodega={};
		var estado="1";
		if(item.estado_bod=="1"){
			estado="0";
		}else{
			estado="1";
		}
		aux_bodega={
			id_bod: item.id_bod,
			estado_bod: estado
		};

		$http.post("activar_inactivar_bodega",aux_bodega)
		.success(function(data){
			console.log(data);
			$scope.get_bodegas();
		});


	};

	$scope.aux_edit_producto={};
	$scope.aux_edicion="0";
	$scope.init_edit=function(item){
		console.log(item);

		$scope.aux_edit_producto=item;
		$scope.newandedit="1";
		$scope.aux_edicion="1";

		$scope.descripcion_bod=item.descripcion_bod; 
		$scope.direccion_bod=item.direccion_bod;
		

	};

	$scope.save_edit=function() {
		var data_bodega={
			id_bod:$scope.aux_edit_producto.id_bod,
			descripcion_bod:$scope.descripcion_bod, 
			direccion_bod: $scope.direccion_bod,
			estado_bod:'1'
		}

		$http.post("save_edit_bodega",data_bodega)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_bodegas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al modificar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_bodegas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	};

});




