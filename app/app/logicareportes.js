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

	$scope.get_kardex_invetario=function(){
		/*var doc = new jsPDF('p','cm','A4');
		doc.setFontSize(9);
		
		doc.setLineWidth(0.01);

		doc.rect(1, 2, 1, 1);

		doc.text(2.2, 2.5, 'jsPDF');

		doc.rect(2, 2, 2, 1);*/

		var docDefinition = { content: 'This is an sample PDF printed with pdfMake' };
		pdfMake.createPdf(docDefinition).print();


	};
	

	

});




