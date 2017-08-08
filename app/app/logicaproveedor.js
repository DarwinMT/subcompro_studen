app.controller("logicaproveedor",function($scope,$http){
	$scope.Titulo="Proveedores";
	$scope.Mensaje="";
	$scope.list_permisos={};


	$scope.get_notificaciones=function() {
		var f = new Date();
		var fecha=f.getFullYear()+"-"+(f.getMonth() +1)+"-"+f.getDate();
		var filtro={
			Hoy:fecha
		};
		$http.post("get_cant_productos",filtro)
		.success(function(data){
			console.log(data);
			$(".notificaciones").html("");
			data.forEach(function(e){
				if(parseInt(e.Cantidad)<=10){
					var not="";
					not+="<div class='alert alert-danger' style='float: left; margin-left: 78%;width: 27%; box-shadow: 0px 0px 10px darkgrey;' role='alert'>";
					not+="<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
					not+=" A la fecha de hoy el proudcto :"+e.nombre_prod+" con codigo: "+e.codigo_prod+" tiene en stock: "+e.Cantidad+" ";
					not+="</div>";
					$(".notificaciones").append(not);
				}
			});

			setTimeout(function(){
				$(".notificaciones").hide("slow");
			},5000);
		});
	};

	
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
				$scope.get_proveedore();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al guardar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_proveedore();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
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
		$scope.aux_edit_proveedor={};

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

	$scope.aux_edit_proveedor={};
	$scope.aux_edicion="0";
	$scope.init_edit=function(item){
		console.log(item);

		$scope.aux_edit_proveedor=item;
		$scope.newandedit="1";
		$scope.aux_edicion="1";

		$scope.dni_per=item.dni_per; 
		$scope.nombre_per=item.nombre_per;
		$scope.apellido_per=item.apellido_per; 
		$scope.genero_per=item.genero_per; 
		$scope.direccion_per=item.direccion_per; 
		$scope.telefono_per=item.telefono_per; 
		$scope.celular_per=item.celular_per; 
		$scope.correo_per=item.correo_per; 
		$scope.direccion_emp_pro=item.direccion_emp_pro;
		$scope.telefono_emp_pro=item.telefono_emp_pro;
	};

	$scope.save_edit=function() {
		var data_persona={
			id_per:$scope.aux_edit_proveedor.id_per,
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
			id_pro:$scope.aux_edit_proveedor.id_pro,
			direccion_emp_pro:$scope.direccion_emp_pro,
			telefono_emp_pro:$scope.telefono_emp_pro,
			id_per: $scope.aux_edit_proveedor.id_per
		}
		var proveedor_editado={
			Persona: data_persona,
			Proveedor:data_proveedor
		};

		$http.post("save_edit_proveedor",proveedor_editado)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_proveedore();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al modificar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_proveedore();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	};

});




