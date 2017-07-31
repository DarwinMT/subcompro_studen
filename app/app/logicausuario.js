app.controller("logicausuarios",function($scope,$http){
	$scope.Titulo="Usuarios";
	$scope.Mensaje="";
	$scope.list_permisos={};

	$scope.newandedit="0";
	$scope.aux_edicion="1";
	$scope.usuariosincondatos="0";


	$scope.get_permisos=function() {
		$http.get("get_permisos_proveedor")
			.success(function(data){
				data.forEach(function(permiso){
					if(permiso.Id_menu==1){
						$scope.list_permisos=permiso;
					}
				});
				console.log($scope.list_permisos);
			})
			.error(function(data){
				console.log(data);
		});
	};

	$scope.int_usuario=function(){ /////// pendiente aun falta xD 
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
			usuario_usu:$scope.usuario_usu,
			password_usu:$scope.password_usu,
			id_per:''
		}
		var usuario={
			Persona: data_persona,
			Usuario:data_proveedor
		};
		$http.post("save_usuario",usuario)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_usuarios();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al guardar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_usuarios();
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
		$scope.usuario_usu="";
		$scope.password_usu="";
		$scope.aux_edit_proveedor={};

	};
	$scope.cmb_estado="1";
	$scope.txt_buscar="";
	$scope.lista_usuario=[];
	
	$scope.get_usuarios=function(){
		var filtro={
			estado:$scope.cmb_estado,
			buscar: $scope.txt_buscar
		};
		$http.post("list_usuario",filtro)
		.success(function(data){
			console.log(data);
			$scope.lista_usuario=data;
		});

	};
	

	$scope.list_menu=[];
	$scope.aux_user_permisos={};
	$scope.permisos_usuario=function(user) {

		$scope.newandedit="3";
		$scope.usuariosincondatos="0";


		$scope.aux_user_permisos=user;

		$scope.descripcion_rol=$scope.aux_user_permisos.Name_permiso;

		$http.get("menu")
		.success(function(data){
			console.log(data);
			$scope.list_menu=[];

			data.forEach(function(item) {
				var aux_menu={
					"Id_menu": item.id_menu,
					"Descipcion": item.descripcion_menu,
					"access_save": false,
					"access_edit": false,
					"access_delete": false,
					"access_print": false
				};
				$scope.list_menu.push(aux_menu);	
			});

			if($scope.aux_user_permisos.Permisos_usuario!=""){
				var permisos_actual_user=JSON.parse($scope.aux_user_permisos.Permisos_usuario);
				console.log(permisos_actual_user);
				
				permisos_actual_user.forEach(function(p){
					$scope.list_menu.forEach(function(m){
						if(p.Id_menu==m.Id_menu){
							if(p.access_save=="1"){
								m.access_save=true;
							}else{
								m.access_save=false;
							}

							if(p.access_edit=="1"){
								m.access_edit=true;
							}else{
								m.access_edit=false;
							}

							if(p.access_delete=="1"){
								m.access_delete=true;
							}else{
								m.access_delete=false;
							}

							if(p.access_print=="1"){
								m.access_print=true;
							}else{
								m.access_print=false;
							}
						}
					});
				});

			}
		});



	};

	$scope.asigna_permiso_user=[];
	$scope.save_permisos_usuario=function(){

		$scope.asigna_permiso_user=[];

		console.log($scope.list_menu);
		var aux_permiso=$scope.list_menu;
		var aux=aux_permiso;
		aux_permiso.forEach(function(p){
			if(p.access_save!=false ||  p.access_edit!=false || p.access_delete!=false || p.access_print!=false ){
				if(p.access_save==false){
					p.access_save="0";
				}else{
					p.access_save="1";
				}

				if(p.access_edit==false){
					p.access_edit="0";
				}else{
					p.access_edit="1";
				}

				if(p.access_delete==false){
					p.access_delete="0";
				}else{
					p.access_delete="1";
				}

				if(p.access_print==false){
					p.access_print="0";
				}else{
					p.access_print="1";
				}

				$scope.asigna_permiso_user.push(p);
			}
		});

		if($scope.aux_user_permisos.id_rol==""){ // el usuario aun no tiene permisos se los asigna y se los guarda en la db

			var data_permisos={
				descripcion_rol:$scope.descripcion_rol, 
				permiso_modulo:$scope.asigna_permiso_user, 
				estado_rol:'1', 
				id_usu: $scope.aux_user_permisos.id_usu
			};
		
			$http.post("save_permisos_usuario",data_permisos)
			.success(function(data){
				if(parseInt(data)>0){
					$scope.Mensaje="Se guardo correctamente";
					$("#sms").modal("show");
					$scope.clear_data();
					setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
					$scope.get_usuarios();
					$scope.newandedit="0";
					$scope.aux_edicion="0";
				}else{
					$scope.Mensaje="Error al modificar";
					$("#sms").modal("show");
					$scope.clear_data();
					setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
					$scope.get_usuarios();
					$scope.newandedit="0";
					$scope.aux_edicion="0";
				}
			});
		}else{ // ya tiene permisos y se los modofica en la db

			var data_permisos={
				id_rol:$scope.aux_user_permisos.id_rol,
				descripcion_rol:$scope.descripcion_rol, 
				permiso_modulo:$scope.asigna_permiso_user, 
				estado_rol:'1', 
				id_usu: $scope.aux_user_permisos.id_usu
			};
			
			$http.post("edit_permisos_usuario",data_permisos)
			.success(function(data){
				if(parseInt(data)>0){
					$scope.Mensaje="Se guardo correctamente";
					$("#sms").modal("show");
					$scope.clear_data();
					setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
					$scope.get_usuarios();
					$scope.newandedit="0";
					$scope.aux_edicion="0";
				}else{
					$scope.Mensaje="Error al modificar";
					$("#sms").modal("show");
					$scope.clear_data();
					setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
					$scope.get_usuarios();
					$scope.newandedit="0";
					$scope.aux_edicion="0";
				}
			});
		}

	};


	////----- la logica aplicadad para proveedor funciona tambien para usuario xD (solo para el estado xD ) 
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
			$scope.get_usuarios();
		});


	};

	$scope.aux_edit_usuario={};
	$scope.aux_edicion="0";
	$scope.init_edit=function(item){
		console.log(item);

		$scope.aux_edit_usuario=item;
		$scope.newandedit="1";
		$scope.aux_edicion="1";
		$scope.usuariosincondatos="1";

		$scope.dni_per=item.dni_per; 
		$scope.nombre_per=item.nombre_per;
		$scope.apellido_per=item.apellido_per; 
		$scope.genero_per=item.genero_per; 
		$scope.direccion_per=item.direccion_per; 
		$scope.telefono_per=item.telefono_per; 
		$scope.celular_per=item.celular_per; 
		$scope.correo_per=item.correo_per; 
		$scope.usuario_usu=item.usuario_usu;
		$scope.password_usu=item.password_usu;
	};

	$scope.save_edit=function() {
		var data_persona={
			id_per:$scope.aux_edit_usuario.id_per,
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
		var data_usuario={
			id_usu:$scope.aux_edit_usuario.id_usu,
			usuario_usu:$scope.usuario_usu,
			password_usu:$scope.password_usu,
			id_per: $scope.aux_edit_usuario.id_per
		}
		var usuario_editado={
			Persona: data_persona,
			Usuario:data_usuario
		};

		$http.post("save_edit_usuario",usuario_editado)
		.success(function(data){
			if(parseInt(data)>0){
				$scope.Mensaje="Se guardo correctamente";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_usuarios();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al modificar";
				$("#sms").modal("show");
				$scope.clear_data();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_usuarios();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	};

});




