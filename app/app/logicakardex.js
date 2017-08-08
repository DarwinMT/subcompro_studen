app.controller("logicakardex",function($scope,$http){
	$scope.Titulo="Kardex";
	$scope.Mensaje="";
	$scope.list_permisos={};

	$scope.newandedit="0";


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
	}



	$scope.get_permisos=function() {
		$http.get("get_permisos_proveedor")
			.success(function(data){
				data.forEach(function(permiso){
					if(permiso.Id_menu==3){
						$scope.list_permisos=permiso;
					}
				});
				console.log($scope.list_permisos);
			})
			.error(function(data){
				console.log(data);
		});
	};

	$scope.cmb_producto="";
	$scope.lista_productos=[];
	$scope.get_productos=function(){
		var filtro={
			estado:'1',
			buscar:''
		};
		$http.post("list_producto",filtro)
		.success(function(data){
			$scope.lista_productos=data;
		});

	};

	$scope.lista_bodegas2=[];
	$scope.cmb_bodega="";
	$scope.get_kardex_invetario_all=function(){
		var filtro={
			estado:'1',
			buscar:'' 
		};
		$http.post("list_bodegas",filtro)
		.success(function(data){
			$scope.lista_bodegas2=data;
		});

	};

	$scope.cmb_acccion="1";
	$scope.descripcion_cant_kar="";
	$scope.txt_cantidad="";
	$scope.int_kardex=function(){
		if($scope.cmb_producto!=""){
			if($scope.cmb_bodega!=""){
				if($("#txt_fecha").val()!=""){
					if(parseInt($scope.txt_cantidad)>0){

						var producto_bodega={
							id_prod:$scope.cmb_producto, 
							id_bod:$scope.cmb_bodega
						};

						var aux_cantidade=0;
						var aux_cantidadi=0;
						if($scope.cmb_acccion=="1"){ // ingresa producto de la bodega
							aux_cantidadi=$scope.txt_cantidad;
						}else{ //sale  producto de la bodega
							aux_cantidade=$scope.txt_cantidad;
						}
						var kardex={
							cant_entrada_kar:aux_cantidadi,
							cant_salida_kar: aux_cantidade,
							fecha_kar:$("#txt_fecha").val(), 
							descripcion_cant_kar:$scope.descripcion_cant_kar,
							id_pd:''
						};

						var data_procesos_kardex={
							dataproductobodega: producto_bodega,
							datakardex:kardex
						};


						$http.post("save_kardex",data_procesos_kardex)
						.success(function(data){
							if(parseInt(data)>0){
								$scope.Mensaje="Se guardo correctamente";
								$("#sms").modal("show");
								$scope.clear_kardex();
								setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
								$scope.get_kardex_invetario();
								$scope.newandedit="0";
								$scope.aux_edicion="0";
							}else{
								$scope.Mensaje="Error al guardar";
								$("#sms").modal("show");
								$scope.clear_kardex();
								setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
								$scope.get_kardex_invetario();
								$scope.newandedit="0";
								$scope.aux_edicion="0";
							}
						});


					}else{
						$scope.Mensaje="Ingrese una cantidad mayor a cero";
						$("#sms").modal("show");
						setTimeout(function(){ $("#sms").modal("hide"); }, 1500);	
					}

				}else{
					$scope.Mensaje="Seleccione una fecha";
					$("#sms").modal("show");
					setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				}

			}else{
				$scope.Mensaje="Seleccione una bodega";
				$("#sms").modal("show");
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
			}
		}else{
			$scope.Mensaje="Seleccione un producto";
			$("#sms").modal("show");
			setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
		}
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
				$scope.clear_kardex();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_kardex_invetario();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al guardar";
				$("#sms").modal("show");
				$scope.clear_kardex();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_kardex_invetario();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	
	};

	$scope.clear_kardex=function(){
		$scope.cmb_producto="";
		$scope.cmb_bodega="";
		$scope.cmb_acccion="1";
		$scope.txt_cantidad="";
		
		$("#txt_fecha").val("");

		$scope.descripcion_cant_kar="";
		

		$scope.aux_edit_producto={};

	};
	$scope.cmb_estado="1";
	$scope.busca_producto="";
	$scope.lista_kardex_producto=[];
	$scope.get_kardex_invetario=function(){
		if($scope.busca_producto!=""){
			if($("#txt_fechabusca").val()!=""){
				var filtro={
					buscar: $scope.busca_producto,
					fecha: $("#txt_fechabusca").val()
				};
				$http.post("kardex_producto",filtro)
				.success(function(data){
					var aux=[];
					$scope.lista_kardex_producto=[];
					var cantidad=0;
					data.forEach(function(e){
						cantidad+=( parseInt(e.cant_entrada_kar) - parseInt(e.cant_salida_kar) );
						var item={
							nombre_prod:e.nombre_prod,
							codigo_prod: e.codigo_prod,
							fecha_kar: e.fecha_kar,
							descripcion_bod: e.descripcion_bod,
							cant_entrada_kar: e.cant_entrada_kar,
							cant_salida_kar :e.cant_salida_kar,
							balance: cantidad
						}
						$scope.lista_kardex_producto.push(item);
					});
					//$scope.lista_kardex_producto=data;
				});
			}
		}
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
			$scope.get_kardex_invetario();
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
				$scope.clear_kardex();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_kardex_invetario();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}else{
				$scope.Mensaje="Error al modificar";
				$("#sms").modal("show");
				$scope.clear_kardex();
				setTimeout(function(){ $("#sms").modal("hide"); }, 1500);
				$scope.get_kardex_invetario();
				$scope.newandedit="0";
				$scope.aux_edicion="0";
			}
		});
	};

});




