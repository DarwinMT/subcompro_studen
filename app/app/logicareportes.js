app.controller("logicareporte",function($scope,$http){
	$scope.Titulo="Reportes";
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
			},2000);
		});
	};



	$scope.get_permisos=function() {
		$http.get("get_permisos_proveedor")
			.success(function(data){
				data.forEach(function(permiso){
					if(permiso.Id_menu==5){
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
	$scope.busca_producto="";
	$scope.get_kardex_invetario=function(){
		
		if($("#txt_fechabusca").val()!=""){
			if($scope.busca_producto!=""){
				var filtro={
						fecha:$("#txt_fechabusca").val(),
						id_prod: $scope.busca_producto,
						id_bod:$scope.cmb_bodega
					};
				$http.post("list_data_reporte",filtro)
				.success(function(data){
					var aux=[];
					$scope.list_data=[];
					var cantidad=0;
					var x=1;
					data.forEach(function(e){
						cantidad+=( parseInt(e.cant_entrada_kar) - parseInt(e.cant_salida_kar) );
						var item=[
							{text: ''+x+'', style: 'texttable'},
							{text: ''+e.nombre_prod+'', style: 'texttable'},
							{text: ''+e.codigo_prod+'', style: 'texttable'},
							{text: ''+e.fecha_kar+'', style: 'texttable'},
							{text: ''+e.descripcion_bod+'', style: 'texttable'},
							{text: ''+e.descripcion_cant_kar+'', style: 'texttable'},
							{text: ''+e.cant_entrada_kar+'', style: 'texttable'},
							{text: ''+e.cant_salida_kar+'', style: 'texttable'},
							{text: ''+cantidad+'', style: 'texttable'},
						];
						$scope.list_data.push(item);
						x++;
					});
					$scope.make_reporte($scope.list_data);
				});
			}else{
				alert("Seleccione un producto");
			}
		}else{
			alert("Seleccione una fecha");
		}

	};
	$scope.make_reporte=function(data){
		var f =new Date();
		var fecha=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()
		var docDefinition = {

		content: [
			{text: 'REPORTE DE INVENTARIO', style: 'header'},
			{text: 'Fecha: '+fecha, style: 'subheader'},
			{
				style: 'styletable',
				table: {
					body: $scope.make_body_reporte(data)
				}
			}
		],
		styles: {
			header: {
				fontSize: 18,
				bold: true,
				alignment: 'center'
			},
			subheader: {
				fontSize: 16,
				bold: true,
				alignment: 'right'
				//margin: [0, 10, 0, 5]
			},
			styletable: {
				margin: [0, 5, 0, 15]
			},
			tableHeader: {
				bold: true,
				fontSize: 10,
				color: 'black'
			},
			texttable: {
				fontSize: 10,
				color: 'black'
			}
		}

		};
		pdfMake.createPdf(docDefinition).print();
	};

	$scope.make_body_reporte=function(data){
		var body=[];
		var head=[];
		head=[
			{text: '', style: 'tableHeader'},
			{text: 'PRODUCTO', style: 'tableHeader'},
			{text: 'CODIGO', style: 'tableHeader'},
			{text: 'FECHA', style: 'tableHeader'},
			{text: 'BODEGA', style: 'tableHeader'},
			{text: 'DESCRIPCION', style: 'tableHeader'},
			{text: 'ENTRADA', style: 'tableHeader'},
			{text: 'SALIDA', style: 'tableHeader'},
			{text: 'BALANCE', style: 'tableHeader'}
		];
		body.push(head);
		for(var x=0;x<data.length;x++){
			body.push(data[x]);
		}
		return body;
	};
	

	

});




