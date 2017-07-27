app.controller("logicaproveedor",function($scope,$http){
	$scope.Titulo="Proveedores";
	$scope.Mensaje="";
	$scope.list_permisos={};

	$scope.newandedit="0";
	$scope.get_permisos=function() {
		$http.get("get_permisos_proveedor")
			.success(function(data){
				data.forEach(function(permiso){
					if(permiso.Id_menu==2){
						$scope.list_permisos=permiso;
					}
				});
				console.log($scope.list_permisos);
			})
			.error(function(data){
				console.log(data);
		});
	};

	$scope.int_proveedor=function(){
		var data_persona={
			dni_per:$scope.dni_per, 
			nombre_per: $scope.nombre_per,
			apellido_per:$scope.apellido_per, 
			genero_per:$scope.genero_per, 
			direccion_per:$scope.direccion_per, 
			telefono_per:$scope.telefono_per, 
			celular_per:$scope.celular_per, 
			correo_per:$scope.correo_per, 
			estado_per:'1'
		}
		var data_proveedor={
			direccion_emp_pro:$scope.direccion_emp_pro,
			telefono_emp_pro:$scope.telefono_emp_pro,
			id_per:''
		}
		var proveedor={
			Persona: data_persona,
			Proveedor:data_proveedor
		};
		$http.post("save_proveedor",proveedor)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
			}else{
				$scope.Mensaje="Error al guardar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
			}
		});
	
	};

	$scope.clear_data=function(){
		$scope.dni_per=""; 
		$scope.nombre_per="";
		$scope.apellido_per=""; 
		$scope.genero_per=""; 
		$scope.direccion_per=""; 
		$scope.telefono_per=""; 
		$scope.celular_per=""; 
		$scope.correo_per=""; 
		$scope.direccion_emp_pro="";
		$scope.telefono_emp_pro="";
	};
	$scope.cmb_estado="1";
	$scope.txt_buscar="";
	$scope.lista_proveedor=[];
	$scope.get_proveedore=function(){
		var filtro={
			estado:$scope.cmb_estado,
			buscar: $scope.txt_buscar
		};
		$http.post("list_proveedor",filtro)
		.success(function(data){
			$scope.lista_proveedor=data;
		});

	};

	$scope.activar_inactivar=function(item){
		console.log(item);
		var aux_proveedor={};
		var estado="1";
		if(item.estado_per=="1"){
			estado="0";
		}else{
			estado="1";
		}
		aux_proveedor={
			id_per: item.id_per,
			estado_per: estado
		};

		$http.post("activar_inactivar",aux_proveedor)
		.success(function(data){
			console.log(data);
			$scope.get_proveedore();
		});


	};

});




