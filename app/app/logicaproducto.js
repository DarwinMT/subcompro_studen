app.controller("logicaproducto",function($scope,$http){
	$scope.Titulo="Producto";
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

	$scope.aux_marca="";
	$scope.lista_marcas=[];
	$scope.get_marcas=function(){
		var filtro={
			estado: "1",
			buscar: ""
		};
		$http.post("list_marcas",filtro)
		.success(function(data){
			$scope.lista_marcas=data;
		});

	};


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
		if($scope.aux_marca!=""){
			var data_producto={
				nombre_prod:$scope.nombre_prod, 
				categoria_prod: $scope.categoria_prod,
				precio_prod:$scope.precio_prod, 
				codigo_prod:$scope.codigo_prod, 
				estado_prod:'1'
			}
			var marcap={
				id_mar: $scope.aux_marca,
				id_pro: $scope.aux_proveedor,
				id_prod:''
			};
			var mara_producto={
				Producto:data_producto ,
				marcapp: marcap
			};
			$http.post("save_producto",mara_producto)
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
		}else{
			alert("Seleccione una marca");
		}
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

	$scope.lista_proveedor=[];
	$scope.aux_proveedor="";
	$scope.get_proveedore=function(){
		var filtro={
			estado: "1",
			buscar: ""
		};
		$http.post("list_proveedor",filtro)
		.success(function(data){
			$scope.lista_proveedor=data;
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
			if(isNaN(data)) alert("No se puede eliminar el producto porque cuenta con movimientos en el kardex");
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

		$scope.aux_marca=item.id_mar;
		$scope.aux_proveedor=item.id_pro;
	};

	$scope.save_edit=function() {
		if($scope.aux_marca!="" ){
			var data_producto={
				id_prod:$scope.aux_edit_producto.id_prod,
				nombre_prod:$scope.nombre_prod, 
				categoria_prod: $scope.categoria_prod,
				precio_prod:$scope.precio_prod, 
				genero_per:$scope.genero_per, 
				codigo_prod:$scope.codigo_prod,
				estado_prod:'1'
			};

			var marcap={
				id_mar: $scope.aux_marca,
				id_pro: $scope.aux_proveedor,
				id_prod:$scope.aux_edit_producto.id_prod
			};


			var producotpp={
				Producto: data_producto,
				marcapp:marcap
			};
			

			$http.post("save_edit_producto",producotpp)
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
		}else{
			alert("Seleccione una marca");
		}
	};

});




