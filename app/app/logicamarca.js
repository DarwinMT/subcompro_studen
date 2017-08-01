app.controller("logicamarca",function($scope,$http){
	$scope.Titulo="Marca";
	$scope.Mensaje="";
	$scope.list_permisos={};

	$scope.newandedit="0";
	$scope.get_permisos=function() {
		$http.get("get_permisos_proveedor")
			.success(function(data){
				data.forEach(function(permiso){
					if(permiso.Id_menu==7){
						$scope.list_permisos=permiso;
					}
				});
				console.log($scope.list_permisos);
			})
			.error(function(data){
				console.log(data);
		});
	};

	$scope.int_marca=function(){
		var data_marca={
			descripcion_mar:$scope.descripcion_mar, 
			estado_mar:'1'
		}
		$http.post("save_marca",data_marca)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_marcas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al guardar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_marcas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	
	};

	$scope.clear_data=function(){
		$scope.descripcion_mar=""; 
		
		$scope.aux_edit_marca={};

	};
	$scope.cmb_estado="1";
	$scope.txt_buscar="";
	$scope.lista_marcas=[];
	$scope.get_marcas=function(){
		var filtro={
			estado:$scope.cmb_estado,
			buscar: $scope.txt_buscar
		};
		$http.post("list_marcas",filtro)
		.success(function(data){
			$scope.lista_marcas=data;
		});

	};

	$scope.activar_inactivar=function(item){
		console.log(item);
		var aux_marca={};
		var estado="1";
		if(item.estado_mar=="1"){
			estado="0";
		}else{
			estado="1";
		}
		aux_marca={
			id_mar: item.id_mar,
			estado_mar: estado
		};

		$http.post("activar_inactivar_marca",aux_marca)
		.success(function(data){
			console.log(data);
			$scope.get_marcas();
		});


	};

	$scope.aux_edit_marca={};
	$scope.aux_edicion="0";
	$scope.init_edit=function(item){
		console.log(item);

		$scope.aux_edit_marca=item;
		$scope.newandedit="1";
		$scope.aux_edicion="1";

		$scope.descripcion_mar=item.descripcion_mar; 
		
	};

	$scope.save_edit=function() {
		var data_marca={
			id_mar:$scope.aux_edit_marca.id_mar,
			descripcion_mar:$scope.descripcion_mar, 
			estado_mar:'1'
		}
		

		$http.post("save_edit_marca",data_marca)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_marcas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al modificar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_marcas();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	};

});




